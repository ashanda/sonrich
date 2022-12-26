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
    $parent_level_node = array($parent_level_node_data->y,$parent_level_node_data->x);

    $shadow_map_level = $current_node->y;
    $shadow_map_x = $current_node->x;
    $shadow_map_id = $current_node->id; 
    $level_gap = $shadow_map_level - $relative_level;



    while($new_user_coordinates[0] != -1){
        place_user($shadow_map_id);

        if($new_user_coordinates[0] != -1){

        $new_user_coordinates = new shadow_map;
        $new_user_coordinates->y = $new_user_coordinates[0];
        $new_user_coordinates->x = $new_user_coordinates[1];

        $level_commission_logs->save();


        }

        $relative_level ++;
    }


}

$parent_level_nodes ;
$current_level_nodes ;
$current_level_map_model ;
$rearrange_current_level_map ;

function place_user($current_node){

    $shadow_map_level = 0;
    $relative_level = 0;
   
    $parent_node_count = 0 ;

    while(count($parent_level_nodes)){
        $current_maps_data = shadow_map::where('parent_node', $parent_level_nodes[$parent_node_count])->get();
        $current_map = $current_maps_data->id;

        $left_child_x = 0;
        $right_child_x = 0;
        
        if( $current_maps_data == null)
        {
            for($x=0; $x<2; $x++ ){
                if($x = 0){
                    $current_level_nodes_add_element();
                }else{
                    $new_node-> $x;
                }
            }

        }else{

        }
        


        foreach($current_maps_data as $new_node){
            $new_node_id = $new_node->id;
            $new_node_side = $new_node->reference_node_side;
            
            // if new node is the left node
            if( $new_node_side == 0){
                $new_node_x = (2*( $new_node->x )) - 1;
            }else{
                $new_node_x = 2*( $new_node->x) ;
            }

           
           
            $parent_node_count ++;
        }

        $a = 0;
        foreach($current_level_map_model as $map_model){
            $new_map_node = $map_model -1;
            $rearrange_current_level_map[$a] = array($current_level_nodes[$new_map_node] );

           if($current_level_nodes [$map_model - 1][1] == -1){
            $current_node_x = $mapmodel - 1;
            $returnarray = [
                ($current_node + $levelgap ), $current_level_nodes[$current_node_x ][0] 
            ];
           }

           $parent_level_nodes = $current_level_nodes ;
           return ([-1,-1]);
        }


    }

}

