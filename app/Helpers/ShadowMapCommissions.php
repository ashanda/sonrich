<?php

Use App\Models\Kyc;
Use App\Models\User;
Use App\Models\daily_commission_log;
Use App\Models\direct_commission_log;
Use App\Models\binary_commission_log;
Use App\Models\level_commission_log;
Use App\Models\shadow_map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

function ShadowMapCommissions($current_user_id, $binary_points, $level_points, $direct_point, $reference_oder_id){
    
  
    $currentuser_map = shadow_map::where('user_id', $current_user_id)->where('status',1)->first();
    
    $parent_node = $currentuser_map->parent_node;
    $current_node = shadow_map::where('id', $parent_node)->where('status',1)->first();
    

    $direct_parent = User::where('id', $current_user_id)->first();
    $direct_parent_id = $direct_parent->parent;
    

    if($current_node == NULL){
      $current_node = shadow_map::where('id', $parent_node)->where('status',0)->latest()->first();
      
        //Not assigned direct commission
        
    }else{

        //Direct Commission
        DirectCommissionCalc($direct_parent_id, $direct_point,$reference_oder_id);
    }
     
    
    //loop
    $i = 1;
     
    while ( $parent_node > 0) {    
        
          Log::info($parent_node. '- Node');
          if($current_node->status != 1){
            Log::info($parent_node. '- Skip Nodes');
            $currentuser_map = shadow_map::where('id', $current_node->id)->first();  
            $parent_node = $currentuser_map->parent_node;       
            $current_node = shadow_map::where('id', $parent_node)->first();
            continue; // skip the rest of the code and continue the loop
            
          }else{
            Log::info($parent_node. '- Binary Node');
            //binary Commission
            BinaryCommissionCalc($current_node->user_id,$binary_points,$reference_oder_id,$currentuser_map->reference_node_side);

            //level commission
            if( $i <= 10){
              Log::info($parent_node. '- Level Node');
              $relative_level = $i;
             LevelCommissionCalc($current_node->user_id,$level_points,$reference_oder_id,$relative_level);
            }

            $currentuser_map = shadow_map::where('id', $current_node->id)->first();  
            $parent_node = $currentuser_map->parent_node;        
            $current_node = shadow_map::where('id', $parent_node)->first();

          }

      $i++;
      
    } 

   
 
     
 } 


  
