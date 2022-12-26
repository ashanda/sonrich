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
    $parent_level_nodes = array($parent_level_node_data->y,$parent_level_node_data->x);
    

    $shadow_map_level = $parent_level_node_data->y;
    $shadow_map_x = $parent_level_node_data->x;
    $shadow_map_id = $parent_level_node_data->id; 
    $level_gap = $shadow_map_level - $relative_level;



    while($new_user_coordinates[0] != -1){
        place_user($shadow_map_id);

        if($new_user_coordinates[0] != -1){

        $new_user_coordinates = new shadow_map;
        $new_user_coordinates->y = $new_user_coordinates[0];
        $new_user_coordinates->x = $new_user_coordinates[1];

        $level_commission_logs->save();


        }
        $shadow_map_level ++;
        $relative_level ++;
    }



}




function place_user($current_node){
    /*

       In this function, you get parent nodes list array and get each and every nod. Then find both 
       childs of all the parent users. If a child exists, we get their coordinates, else we add -1 
       to identify this is an empty node.

       Once we list all two childs of each parent node, that becomes the current_level_nodes array. 
       We match it with $current_level_map_model and rearrange. While re-arranging, we find the first 
       empty node and return the x,y values back. 
       
    */
    $parent_level_nodes = array(array(1,2));
  
    $shadow_map_level = 0;
    $relative_level = 0;   
    $parent_node_count = 0 ; // this is $j
    $is_empty_node_available = false;

    while(count($parent_level_nodes)){
      
      //  $parent_level_nodes[$parent_level_nodes[0][1]];
      
         // Select two childs from above parent
        $two_childs = DB::table('shadow_maps')->where('parent_node', $parent_level_nodes[$parent_node_count][1])->get();       
        $node_id = -1;

        foreach($two_childs as $two_child){
            if( $two_childs[0] ) 
            {
                $two_childs_0 = $two_childs[0];
                
            }

            if( $two_childs[1] ) 
            {
                $two_childs_1 = $two_childs[1];
                
            }
        }

            for($x=0; $x<2; $x++ ){
                if($x == 0){
                    // child node x =( parent node x * 2 ) - 1;
                    $child_node_x =($parent_level_nodes[$parent_node_count][0] * 2 ) - 1;
                    // reference_node_side = left
                   // $reference_node_side = $parent_level_nodes[$parent_node_count][0]-> reference_node_side;
                    // child node y =(parent node y)
                   // $child_node_y =( $parent_level_nodes[$parent_node_count][0]->y );
                    
                    if( $two_childs_0 ) 
                    {
                        $node_id = $two_childs_0->id;
                        
                    }else{
                        // node w = -1
                        $is_empty_node_available = true;
                    }                 
                    
                    $new_left_child = array($child_node_x,$node_id);
                    $new_left_child_data = array_push($parent_level_nodes , $new_left_child);
                    
                    //add new node to $current_level_nodes array
                }else{
                    // child node x =( parent node x * 2 ) ;
                    $child_node_x =( $parent_level_nodes[$parent_node_count][1] * 2 ) - 1;
                    // reference_node_side = right
                 //   $reference_node_side = $parent_level_nodes[$parent_node_count][1]-> reference_node_side;
                    // child node y =(parent node y)
                  //  $child_node_y =( $parent_level_nodes[$parent_node_count][1]->y );

                    if( $two_childs[1] ){
                        $node_id = $two_childs_1->id;
                    }else{
                        $node_id = -1;
                        $is_empty_node_available = true;
                    }

                    $new_left_child = array($child_node_x,$node_id);
                    $new_left_child_data = array_push($parent_level_nodes , $new_left_child);
                    
                    //add new node to $current_level_nodes array
                }
            }
      
        $parent_node_count ++;


    }
    
    $parent_level_nodes = $current_level_nodes ; // Current Level Nodes become the parent node list of next iteration


    // if we don't have new nodes, no use of re-arrange the node array
    if(  $is_empty_node_available ){

        return ([-1,-1]); // which means we don't have empty node at this entire level
    }


            //rearrange 
     $a = 0;
     foreach($current_level_map_model as $map_model){
        /*
        $current_level_map_model is basically the order where current_level_nodes to be rearranged.        
        We have the model of how this level should be arranged in our database.We take it 
        and add to the current_level_map_model for the ralavant level in the current pyramid
        relative to the parent user */

        // Since array count starts from 0 and map model table's starting value is 1,  
        // We need to get one minus to the original value
         $new_map_node = $map_model -1; 
         
         $rearrange_current_level_map[$a] = array($current_level_nodes[$new_map_node] );

        if($current_level_nodes [ $new_map_node][1] == -1){
         $current_node_x = $current_level_nodes [ $new_map_node][0];

         // Ashan : get the parent element's node id from shadow map table
         $new_child_coordinates = [
             ($shadow_map_level + 1 ), $current_level_nodes[$current_node_x ][0] 
         ];

         return $new_child_coordinates;
        }
      
        return ([-1,-1]); // which means we don't have empty node at this entire level
     }

}
