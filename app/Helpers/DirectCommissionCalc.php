<?php
use Monarobase\CountryList\CountryListFacade;
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

function DirectCommissionCalc($current_user_id){

    $nodeparent_map = shadow_map_parent_node_check($current_user_id);

    $nodeparent = $nodeparent_map-> parent_node;
    $parentside = $nodeparent_map-> reference_node_side;
    $currentmapid = $nodeparent_map-> id;

    $currentuser_map = shadow_map::where('user_id', $current_user_id)->first();
    $parent_node = $currentuser_map->parent_node;
    
    $oders_map = oder::where('user_id', $parent_node)->where('status',1)->first();
    $currentuserearningmax = $oders_map->max_value;
    $currentuserearningtotal = $oders_map->total_package_earnings;
    $currentuser = $oders_map->user_id;
    $currentorderid = $oders_map->id;

    if( $level_points >= ( $currentuserearningmax - $currentuserearningtotal ) ){

        $new_level_points = ($currentuserearningmax - $currentuserearningtotal);

        $oder_update = oder::find($currentorderid);
        $oder_update->status = 2;
        $oder_update->total_package_earnings = $currentuserearningmax;
        $oder_update->save();

        $oder_update = shadow_map::find($currentmapid);
        $oder_update->status = 0;
        $oder_update->save();

        $level_commission_logs = new direct_commission_log;
        $level->user_id = $currentuser;
        $level->amount = $new_level_points;
        $level->side = $parentside;
        $level->oder_id = $currentorderid;
        $level->reference_oder_id = $reference_oder_id;
        $dataClient->save();

        // 1/3 product wallet
        product_wallet_update($new_level_points,$current_user_id,$currentorderid,$reference_oder_id);

        // 2/3 cash wallet
        cash_wallet_update($new_level_points,$current_user_id,$currentorderid,$reference_oder_id);
    }else{


    }

    return $countries;

   

    
}