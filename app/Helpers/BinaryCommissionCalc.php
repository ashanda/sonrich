<?php
use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
Use App\Models\User;
use App\Models\oder;
use App\Models\product_wallet;
Use App\Models\daily_commission_log;
Use App\Models\direct_commission_log;
Use App\Models\binary_commission_log;
Use App\Models\binary_commission;
Use App\Models\level_commission_log;
Use App\Models\shadow_map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

function BinaryCommissionCalc( $current_user_id, $binary_points, $reference_oder_id,$reference_node_side){
    

    $nodeparent_map = shadow_map_parent_node_check($current_user_id);

    $nodeparent = $nodeparent_map-> parent_node;
    $parentside = $reference_node_side;
    $currentmapid = $nodeparent_map-> id;
   
    
    $oders_map = oder::where('user_id', $current_user_id)->where('status',1)->first();
    $currentuserearningmax = $oders_map->max_value;
    $currentuserearningtotal = $oders_map->total_package_earnings;
    $currentuser = $oders_map->user_id;
    $currentorderid = $oders_map->id;
    
    
    $binary_commissions = binary_commission::where('user_id', $current_user_id)->first();

   if($binary_commissions == NULL){
        $binary_commissions = new binary_commission();
        $binary_commissions->user_id = $current_user_id;
        $binary_commissions->left_total = 0;
        $binary_commissions->right_total = 0;
        $isReportCreated = $binary_commissions->save();

        $binarycommissiontableid = $binary_commissions->id;
        $leftbalance = $binary_commissions->left_total ;
        $rightbalance = $binary_commissions->right_total ; 
    }else{
        $binarycommissiontableid = $binary_commissions->id;
        $leftbalance = $binary_commissions->left_total ;
        $rightbalance = $binary_commissions->right_total ;
    }
    


    if( $parentside == 0) {
        $leftbalance  += $binary_points;
     }else{
        $rightbalance += $binary_points;
     }

     
     /*SELECT @binarycommissiontableid;*/
 
       if($leftbalance < $rightbalance) {

        $binarycommission = $leftbalance;
        $rightbalance = $rightbalance - $leftbalance;
        $leftbalance = 0;

        }elseif($leftbalance > $rightbalance){

        $binarycommission = $rightbalance ;
        $leftbalance = $leftbalance - $rightbalance;
        $rightbalance = 0;
        }else{
         $binarycommission =  $leftbalance; /* WHEN LB == RB */
         $leftbalance = 0;
         $rightbalance = 0;
        }

        //binary point multiply 1000
        $binarycommission =  $binarycommission * 1000 ;

    /* If the commission is greater than  1:3, assign the possible amount and deactivate the order, remove the user from shadow map  */
        
        
 if($binarycommission >= ( $currentuserearningmax - $currentuserearningtotal ) ){
    
    $binarycommission = ($currentuserearningmax - $currentuserearningtotal);
    if($leftbalance < $rightbalance){

        $rightbalance = $binarycommission;

    }else{

        $leftbalance = $binarycommission;
    }
    
    $binarycommission =  ( $currentuserearningmax - $currentuserearningtotal );

    $binarycommission_update = binary_commission::find($binarycommissiontableid);
    $binarycommission_update->left_total  = $leftbalance;
    $binarycommission_update->right_total = $rightbalance;
    $binarycommission_update->save();
    
    //checking 7 admin heads
    if(admin_head_check($currentmapid) == 1){
            
    }else{
    $oder_update = oder::find($currentorderid);
    $oder_update->status = 2;
    $oder_update->total_package_earnings = $currentuserearningmax;
    $oder_update->save();

    $oder_update = shadow_map::find($currentmapid);
    $oder_update->status = 0;
    $oder_update->save();
    }

    
    $binary_commission_logs = new binary_commission_log;
    $binary_commission_logs->user_id = $currentuser;
    $binary_commission_logs->amount = $binarycommission;
    $binary_commission_logs->side = $parentside;
    $binary_commission_logs->oder_id = $currentorderid;
    $binary_commission_logs->reference_oder_id = $reference_oder_id;
    $binary_commission_logs->save();

    


}else{

    

    
   
    $binarycommission_update = binary_commission::find($binarycommissiontableid);
    $binarycommission_update->left_total = $leftbalance;
    $binarycommission_update->right_total = $rightbalance;
    $binarycommission_update->save();

    $binary_commission_logs = new binary_commission_log;
    $binary_commission_logs->user_id = $currentuser;
    $binary_commission_logs->amount = $binarycommission;
    $binary_commission_logs->side = $parentside;
    $binary_commission_logs->oder_id = $currentorderid;
    $binary_commission_logs->reference_oder_id = $reference_oder_id;
    $binary_commission_logs->save();

    $oder_update = oder::find($currentorderid);
    $oder_update->status = 1;
    $oder_update->total_package_earnings = ($currentuserearningtotal + $binarycommission);
    $oder_update->save();

    
    

}
        
        // 1/3 product wallet
        product_wallet_update($binarycommission,$current_user_id,$currentorderid,$reference_oder_id);

        // 2/3 cash wallet
        cash_wallet_update($binarycommission,$current_user_id,$currentorderid,$reference_oder_id);

   
} 