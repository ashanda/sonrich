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




$parent_level_nodes ;
$current_level_nodes ;
$current_level_map_model ;
$rearrange_current_level_map ;
$current_parent_node ; 


function user_positioning($child_id){
    $level_gap = 0;
    $shadow_map_level = 0;
    $relative_level = 0;
    $current_node_id = 0;

    $current_node_map =  shadow_map::where('user_id', $child_id)->first();
    

    // first time we don't have shadow map

    $current_user_data =  User::where('id', $child_id)->first();
    $current_user = $current_user_data->parent;

    $current_node = $current_node_map->user_id;

    $parent_level_node_data = shadow_map::where('user_id', $current_user)->where('status',1)->first();
    $parent_level_nodes = array(array($parent_level_node_data->y,$parent_level_node_data->x));
    
   //$parent_level_node_data->y gets the parent's Y level. But for the shadow map level, we need current level, so we need to add +1 to the value.
    
    $shadow_map_level = $parent_level_node_data->y+1;
    $shadow_map_x = $parent_level_node_data->x;
    $shadow_map_id = $parent_level_node_data->id; 
    $level_gap = $shadow_map_level - $relative_level;

    $new_user_coordinates = place_user($shadow_map_id);

    $new_user_coordinates_found = 0;

    while($new_user_coordinates_found == 0){
        
       // $new_user_coordinates = place_user($shadow_map_id);
       $new_user_coordinates = place_user($shadow_map_id);
        
        if( $new_user_coordinates[0]  != -1){
           /* $new_user_coordinates = new shadow_map;
            $new_user_coordinates->y = $new_user_coordinates[0];
            $new_user_coordinates->x = $new_user_coordinates[1];
            $new_user_coordinates->user_id = $new_user_coordinates[1];
            $new_user_coordinates->status = $new_user_coordinates[1];
            $new_user_coordinates->prent_node = $new_user_coordinates[1];
            $new_user_coordinates->reference_node_side = $new_user_coordinates[1];
            $new_user_coordinates->x_max = $new_user_coordinates[1];
            $new_user_coordinates->x_count = $new_user_coordinates[1];

            $new_user_coordinates->save();

            */
        } 
        $new_user_coordinates_found=1;
        $shadow_map_level++;
        $relative_level ++;
    }


    

}




function place_user(){
    /*

       In this function, you get parent nodes list array and get each and every nod. Then find both 
       childs of all the parent users. If a child exists, we get their coordinates, else we add -1 
       to identify this is an empty node.

       Once we list all two childs of each parent node, that becomes the current_level_nodes array. 
       We match it with $current_level_map_model and rearrange. While re-arranging, we find the first 
       empty node and return the x,y values back. 
       
    */
    global $parent_level_nodes;
    global $current_level_nodes;
    $shadow_map_level = 0;
    $relative_level = 0;   
    $parent_node_count = 0 ; // this is $j
    global  $current_level_map_model ;
    $is_empty_node_available = false;
    



    
    while(count($parent_level_nodes) > $parent_node_count){
         $child_node_x = $parent_level_nodes[$parent_node_count][0];
         
       // var_dump(count($parent_level_nodes) <= $parent_node_count);
       $two_childs = DB::table('shadow_maps')->where('parent_node', $parent_level_nodes[$parent_node_count][1])->get();     
        
        
        
         if( count($two_childs) == 0){
                 
             $new_left_child  = array( ($child_node_x * 2)  -1 ,  $two_childs[0]->id );
             $new_right_child = array( $child_node_x * 2 , $two_childs[0]->id ); 
             
             if(count($current_level_nodes) == 0){
                $current_level_nodes = array( $new_left_child , $new_right_child );
            }else{
               array_push( $current_level_nodes , $new_left_child , $new_right_child );
            }
             
             $is_empty_node_available = true;
 
                   
         }elseif(count($two_childs) == 1){
 
             $new_left_child  = array();
             $new_right_child = array();
            
            if( $two_childs[0]->reference_node_side == 0){
 
                 $new_left_child  = array( ($child_node_x * 2)  -1 ,  $two_childs[0]->id );
                 
                 $new_right_child = array( $child_node_x * 2 , -1); 
               
             }else{
                 
                 $new_left_child  = array( ($child_node_x * 2)  -1 , -1 );
                 $new_right_child = array( $child_node_x * 2 , $two_childs[0]->id ); 
 
             }

            
            if(count($current_level_nodes) == 0){
                $current_level_nodes = array( $new_left_child , $new_right_child );
            }else{
                
               array_push( $current_level_nodes , $new_left_child , $new_right_child );
            }
             $is_empty_node_available = true;
 
            
 
 
         }else{
            
             $new_left_child  = array();
             $new_right_child = array();
            
             for($x=0; $x<2; $x++ ){
            
                 if( $two_childs[$x]->reference_node_side == 0){
                    
                     $new_left_child  = array( ($child_node_x * 2)-1 ,  $two_childs[$x]->id );        
                                  
                 }else{  
                                          
                     $new_right_child = array($child_node_x * 2 , $two_childs[$x]->id);         
                 }
             }
             
           if(empty($current_level_nodes) == 0){
               $current_level_nodes = array( $new_left_child , $new_right_child );
           }else{
              array_push($current_level_nodes, $new_left_child, $new_right_child );
           }  

                
        
     }
     $parent_node_count ++;
    }

   
    // dd($parent_level_nodes);
   $parent_level_nodes = $current_level_nodes ; // Current Level Nodes become the parent node list of next iteration
    
    // if we don't have new nodes, no use of re-arrange the node array
    if(  !$is_empty_node_available ){

      // return ([-1,-1]); // which means we don't have empty node at this entire level
    }


     //rearrange 

     $a = 0;

     $current_level_map_model = DB::table('shadow_map_models')->select('value_array')->where('virtual_level', ($shadow_map_level+1))->get();
     
     $current_level_map_model =  json_decode($current_level_map_model[0]->value_array);
     
     foreach($current_level_map_model as $map_model){
        /*
        $current_level_map_model is basically the order where current_level_nodes to be rearranged.        
        We have the model of how this level should be arranged in our database.We take it 
        and add to the current_level_map_model for the ralavant level in the current pyramid
        relative to the parent user */

        // Since array count starts from 0 and map model table's starting value is 1,  
        // We need to get one minus to the original value
        //dd($map_model->value_array);

         
         
       // print_r( $map_model);
        $rearrange_current_level_map[$a] = array($current_level_nodes[$map_model] );
        
        
         
        if($current_level_nodes [ $map_model][1] == -1){
         $current_node_x = $current_level_nodes [ $map_model][0];
        
         // Ashan : get the parent element's node id from shadow map table
         $new_child_coordinates = [
             ($shadow_map_level+1), $current_level_nodes[$current_node_x ][0] 
         ];
         
         return $new_child_coordinates;
        }
        $b = array(-1,-1);

        return $b; // which means we don't have empty node at this entire level
     
    }


    $a++; 
    

    }


