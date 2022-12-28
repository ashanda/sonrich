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

function ShadowMapCommissions($current_user_id, $binary_points, $level_points, $direct_point, $reference_oder_id){
    

    $currentuser_map = shadow_map::where('user_id', $current_user_id)->first();
    
    $parent_node = $currentuser_map->parent_node;
    $currentuser = shadow_map::where('user_id', $parent_node)->where('status',1)->first();
    
    


    //loop
    $i = 1;

    while ($currentuser->user_id==0) {    
        
        
        if($currentuser->status != 1){
            break;
        }
        //binary Commission
        BinaryCommissionCalc(5,$binary_points,$reference_oder_id);

     if($i <= 1){
         //Direct Commission
        DirectCommissionCalc(5, $direct_point,$reference_oder_id);
     }

      //level commission
      if( $i <= 10){
        $relative_level = $i;
        LevelCommissionCalc(5,$level_points,$reference_oder_id,$relative_level);
      }

      $currentuser_map = shadow_map::where('user_id', $currentuser)->where('status',1)->first();    
      $parent_node = $currentuser_map->parent_node;         
      $currentuser = shadow_map::where('user_id', $parent_node)->first();
      
      $i++;
      
    } 

   
 
     
 } 


  
