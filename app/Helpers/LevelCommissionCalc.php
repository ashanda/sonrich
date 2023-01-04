<?php
use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
Use App\Models\User;
use App\Models\oder;
use App\Models\shadow_map;
Use App\Models\daily_commission_log;
Use App\Models\direct_commission_log;
Use App\Models\binary_commission_log;
Use App\Models\level_commission_log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

function LevelCommissionCalc($current_user_id, $level_points, $reference_oder_id, $relative_level){
    
    $nodeparent_map = shadow_map_parent_node_check($current_user_id);

    $nodeparent = $nodeparent_map-> parent_node;
    $parentside = $nodeparent_map-> reference_node_side;
    $currentmapid = $nodeparent_map-> id;

    $oders_map = oder::where('user_id', $current_user_id)->where('status',1)->first();
    $currentuserearningmax = $oders_map->max_value;
    $currentuserearningtotal = $oders_map->total_package_earnings;
    $currentuser = $oders_map->user_id;
    $currentorderid = $oders_map->id;

    if( $level_points >= ( $currentuserearningmax - $currentuserearningtotal ) ){

        $new_level_points = ($currentuserearningmax - $currentuserearningtotal);

        $level_commission_logs = new level_commission_log;
        $level_commission_logs->user_id = $currentuser;
        $level_commission_logs->amount = $new_level_points;
        $level_commission_logs->oder_id = $currentorderid;
        $level_commission_logs->reference_oder_id = $reference_oder_id;
        $level_commission_logs->relative_level = $relative_level;
        $level_commission_logs->save();

        $oder_update = oder::find($currentorderid);
        $oder_update->status = 2;
        $oder_update->total_package_earnings = $currentuserearningmax;
        $oder_update->save();

        $oder_update = shadow_map::find($currentmapid);
        $oder_update->status = 0;
        $oder_update->save();

        // 1/3 product wallet
        product_wallet_update($new_level_points,$current_user_id,$currentorderid,$reference_oder_id);

        // 2/3 cash wallet
        cash_wallet_update($new_level_points,$current_user_id,$currentorderid,$reference_oder_id);
    }else{

        $oder_update = oder::find($currentorderid);
        $oder_update->total_package_earnings = $level_points;
        $oder_update->save();

        

        $oder_update = oder::find($currentorderid);
        $oder_update->status = 1;
        $oder_update->total_package_earnings = ($currentuserearningtotal + $level_points);
        $oder_update->save();

        $level_commission_logs = new level_commission_log;
        $level_commission_logs->user_id = $currentuser;
        $level_commission_logs->amount = $level_points;
        $level_commission_logs->oder_id = $currentorderid;
        $level_commission_logs->reference_oder_id = $reference_oder_id;
        $level_commission_logs->relative_level = $relative_level;
        $level_commission_logs->save();

        // 1/3 product wallet
        product_wallet_update($level_points,$current_user_id,$currentorderid,$reference_oder_id);

        // 2/3 cash wallet
        cash_wallet_update($level_points,$current_user_id,$currentorderid,$reference_oder_id);

    }

    
} 