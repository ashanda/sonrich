<?php
use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
Use App\Models\User;
use App\Models\oder;
Use App\Models\daily_commission_log;
Use App\Models\direct_commission_log;
Use App\Models\binary_commission_log;
Use App\Models\binary_commission;
Use App\Models\level_commission_log;
Use App\Models\shadow_map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

function DirectCommissionCalc($current_user_id, $direct_point,$reference_oder_id){

    /*
    $nodeparent_map = shadow_map_parent_node_check($current_user_id);

    $nodeparent = $nodeparent_map->parent_node;
    $parentside = $nodeparent_map->reference_node_side;
    $currentmapid = $nodeparent_map-> id;
    
    $currentuser_map = shadow_map::where('id', $nodeparent)->first();
    
    $parent_node = $currentuser_map->user_id;
    */
    
    $oders_map = oder::where('user_id', $current_user_id)->where('status',1)->first();
    if($oders_map != null){

    
    if($oders_map -> status == 1){
        $currentuserearningmax = $oders_map->max_value;
    $currentuserearningtotal = $oders_map->total_package_earnings;
    $currentuser = $oders_map->user_id;
    $currentorderid = $oders_map->id;
    
    if( $direct_point < ( $currentuserearningmax - $currentuserearningtotal ) || admin_head_check($current_user_id) == 1 ){
        
        $oder_update = oder::find($currentorderid);
        $oder_update->status = 1;
        $oder_update->total_package_earnings = ($currentuserearningtotal + $direct_point);
        $oder_update->save();

        $level_commission_logs = new direct_commission_log;
        $level_commission_logs->user_id = $currentuser;
        $level_commission_logs->amount = $direct_point;
        
        $level_commission_logs->oder_id = $currentorderid;
        $level_commission_logs->reference_oder_id = $reference_oder_id;
        $level_commission_logs->save();

        $description = 'Direct Commission';
        
        $old_cash_wallet = DB::table('cash_wallets')->where('user_id',$current_user_id)->first();
        $old_product_wallet = DB::table('product_wallets')->where('user_id',$current_user_id)->first();
        $spill = 0;

        // 1/3 product wallet
        product_wallet_update($direct_point,$current_user_id,$currentorderid,$reference_oder_id,$description,$old_product_wallet,$spill);

        // 2/3 cash wallet
        cash_wallet_update($direct_point,$current_user_id,$currentorderid,$reference_oder_id,$description,$old_cash_wallet,$spill);
        
        
    }else{
        
        if(admin_head_check($current_user_id) == 1){
            $new_direct_points = $direct_point;
            
        }else{
            $new_direct_points = ($currentuserearningmax - $currentuserearningtotal);
            
        }
        

        

        $nodeparent_map = shadow_map_parent_node_check($current_user_id);
        $nodeparent = $nodeparent_map->parent_node;
        $nodeparent = shadow_map::where('id', $nodeparent)->first();
        $currentmapid = $nodeparent_map-> id;

        //checking 7 admin heads
        if(admin_head_check($currentmapid) == 1){

            $oder_update = oder::find($currentorderid);
            $oder_update->total_package_earnings = $currentuserearningtotal + $direct_point;
            $oder_update->save();
            
        }else{

            $oder_update = oder::find($currentorderid);
            $oder_update->status = 2;
            $oder_update->total_package_earnings = $currentuserearningmax;
            $oder_update->save();
    
            $oder_update = shadow_map::find($currentmapid);
            $oder_update->status = 0;
            $oder_update->save();

        }
        

        $level_commission_logs = new direct_commission_log;
        $level_commission_logs->user_id = $currentuser;
        $level_commission_logs->amount = $new_direct_points;
      
        $level_commission_logs->oder_id = $currentorderid;
        $level_commission_logs->reference_oder_id = $reference_oder_id;
        $level_commission_logs->save();

        $description = 'Direct Commission';

        $old_cash_wallet = DB::table('cash_wallets')->where('user_id',$current_user_id)->first();
        $old_product_wallet = DB::table('product_wallets')->where('user_id',$current_user_id)->first();

        $expect_product_val = ($currentuserearningmax / 3) ;
        $current_product_val = $old_product_wallet->wallet_balance;
        $fixed_product_wallet_val = $expect_product_val - $current_product_val;
        $fixed_cash_wallet_val = $new_direct_points - $fixed_product_wallet_val;
        $spill = 1;
        // 1/3 product wallet

        product_wallet_update($fixed_product_wallet_val,$current_user_id,$currentorderid,$reference_oder_id,$description,$old_product_wallet,$spill);

        // 2/3 cash wallet
        cash_wallet_update($fixed_cash_wallet_val,$current_user_id,$currentorderid,$reference_oder_id,$description,$old_cash_wallet,$spill);    

    }
    }else{
        
    }
}

    

   

    
}