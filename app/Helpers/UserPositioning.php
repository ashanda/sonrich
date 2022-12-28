<?php 

use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
Use App\Models\User;
Use App\Models\cash_wallet;
Use App\Models\shadow_map;
Use App\Models\daily_commission_log;
Use App\Models\direct_commission_log;
Use App\Models\binary_commission_log;
Use App\Models\level_commission_log;
use App\Models\product_wallet;
use App\Models\shadow_map_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;





function user_positioning($child_id){

    global $parent_level_nodes ;
    global $current_level_nodes ;
    global $current_level_map_model ;
    global $rearrange_current_level_map ;
    global $current_parent_node ; 
    $new_user_coordinates = array(-1,-1);
    $shadow_map_level = 0;
    $relative_level = 1; //We start $relative_level from 1, not from 0. Because 0 is for the parent level, since we use $relative_level to grab the current_level_nodes 's matching current_level_map_model ( not the parent's )
    

   // $current_node_map =  shadow_map::where('user_id', $child_id)->first();
    

    // first time we don't have shadow map

    $current_user_data =  User::where('id', $child_id)->first();
    $current_user = $current_user_data->parent;
    
    //$current_node = $current_node_map->user_id;

    $parent_level_node_data = shadow_map::where('user_id', $current_user)->where('status',1)->first();
    $parent_level_nodes = array(array($parent_level_node_data->x,$parent_level_node_data->id));
    
    
   //$parent_level_node_data->y gets the parent's Y level. But for the shadow map level, we need current level, so we need to add +1 to the value.
    
    $shadow_map_level = $parent_level_node_data->y+1;
    
  
    $shadow_map_x = $parent_level_node_data->x;
    $shadow_map_id = $parent_level_node_data->id; 
    $level_gap = $shadow_map_level - $relative_level;
   
    

    

    $new_user_coordinates_found = 0;
    
    while($new_user_coordinates_found == 0){
         
        /*

       In this function, you get parent nodes list array and get each and every nod. Then find both 
       childs of all the parent users. If a child exists, we get their coordinates, else we add -1 
       to identify this is an empty node.

       Once we list all two childs of each parent node, that becomes the current_level_nodes array. 
       We match it with $current_level_map_model and rearrange. While re-arranging, we find the first 
       empty node and return the x,y values back. 
       
    */
     
    $current_level_nodes = array(array());
    $parent_node_count = 0 ; // this is $j
    $current_level_map_model = 0 ;
    $is_empty_node_available = false;
   
    while(count($parent_level_nodes) > $parent_node_count){

         $child_node_x = $parent_level_nodes[$parent_node_count][0];
         
         
       // var_dump(count($parent_level_nodes) <= $parent_node_count);
       $two_childs = DB::table('shadow_maps')->where('parent_node', $parent_level_nodes[$parent_node_count][1])->get();     
       $node_parent_id = $two_childs[0]->parent_node;
       
         if( count($two_childs) == 0){
            
             $new_left_child  = array( ($child_node_x * 2)  -1 ,  -1 , $node_parent_id);
             $new_right_child = array( $child_node_x * 2 , -1 , $node_parent_id); 
             
             if(count($current_level_nodes) == 0){
                $current_level_nodes = array( $new_left_child , $new_right_child);
            }else{
               array_push( $current_level_nodes , $new_left_child , $new_right_child);
            }
             
             $is_empty_node_available = true;

         }elseif(count($two_childs) == 1){
 
             $new_left_child  = array();
             $new_right_child = array();
            
            if( $two_childs[0]->reference_node_side == 0){
                 $new_left_child  = array( ($child_node_x * 2)  -1 ,  $two_childs[0]->id ); 
                 $new_right_child = array( $child_node_x * 2 , -1 , $node_parent_id);               
             }else{                
                 $new_left_child  = array( ($child_node_x * 2)  -1 , -1 ,$node_parent_id );
                 $new_right_child = array( $child_node_x * 2 , $two_childs[0]->id ); 
             }
            if(count($current_level_nodes) == 0){
                $current_level_nodes = array( $new_left_child , $new_right_child);
            }else{    
               array_push( $current_level_nodes , $new_left_child , $new_right_child);
            }
            
             $is_empty_node_available = true;
            
         }else{           
             $new_left_child  = array();
             $new_right_child = array();            
             for($x=0; $x<2; $x++ ){       
                 
                 if( $two_childs[$x]->reference_node_side == 0){                    
                     $new_left_child  = array( ($child_node_x * 2)-1 ,  $two_childs[$x]->id ); 
                     $new_right_child = array( $child_node_x * 2 , -1 , $node_parent_id);                                          
                 }else{                                            
                     $new_right_child = array($child_node_x * 2 , $two_childs[$x]->id ); 
                     $new_right_child = array( $child_node_x * 2 , $two_childs[0]->id );  
                            
                 }
             }  
                       
           if(empty($current_level_nodes)){
               $current_level_nodes = array( $new_left_child , $new_right_child, $node_parent_id);
           }else{
              array_push($current_level_nodes, $new_left_child, $new_right_child, $node_parent_id);
             
           }     
           
           
     }
     $parent_node_count ++;
    }
    
   $parent_level_nodes = $current_level_nodes ; // Current Level Nodes become the parent node list of next iteration
   
   

    // if we don't have new nodes, no use of re-arrange the node array
    if(  !$is_empty_node_available ){
        $new_user_coordinates = array(-1,-1);
        break;
         // which means we don't have empty node at this entire level
    }
    
     //rearrange 

     $a = 0;
     $current_level_map_model = DB::table('shadow_map_models')->select('value_array')->where('virtual_level', ($relative_level))->get();
     
     $current_level_map_model =  json_decode($current_level_map_model[0]->value_array);
     foreach($current_level_map_model as $map_model){
        /*
        $current_level_map_model is basically the order where current_level_nodes to be rearranged.        
        We have the model of how this level should be arranged in our database.We take it 
        and add to the current_level_map_model for the ralavant level in the current pyramid
        relative to the parent user */

        // Since array count starts from 0 and map model table's starting value is 1,  
        // We need to get one minus to the original value
        $rearrange_current_level_map[$a] = array($current_level_nodes[$map_model] );
        
        if($current_level_nodes [ $map_model][1] == -1){
         $current_node_x = $current_level_nodes [ $map_model][0];
        
         // Ashan : get the parent element's node id from shadow map table
         $new_child_coordinates = [($relative_level+1), $current_level_nodes[$current_node_x ][0], $current_level_nodes[$current_node_x ][2]];
         
         $new_user_coordinates_found=1;
         $new_user_coordinates = $new_child_coordinates;
        
       
         
         
            print_r($new_user_coordinates);
          if( $new_user_coordinates[0]  != -1){
              
              $new_user_coordinates_store = new shadow_map;
              $new_user_coordinates_store->y = $new_user_coordinates[0];
              $new_user_coordinates_store->x = $new_user_coordinates[1];
              $reference_node_side = $new_user_coordinates_store->x % 2;
              $new_user_coordinates_store->user_id = $child_id;
              $new_user_coordinates_store->status = 1;
              $new_user_coordinates_store->parent_node = $new_user_coordinates[2];
              $new_user_coordinates_store->reference_node_side =$reference_node_side;
              $new_user_coordinates_store->save();
            
          } 
          
         exit;
        }
       // $new_user_coordinates = array(-1,-1);

     // which means we don't have empty node at this entire level
     $a++;
    }

    }
       
       
        
        $shadow_map_level++;
        $relative_level ++;


        
    }

    
    








