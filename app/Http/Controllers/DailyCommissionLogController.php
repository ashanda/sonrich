<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\daily_commission_log;
use Illuminate\Http\Request;
use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
Use App\Models\User;
Use App\Models\cash_wallet;
Use App\Models\shadow_map;
Use App\Models\direct_commission_log;
Use App\Models\binary_commission_log;
Use App\Models\level_commission_log;
use App\Models\product_wallet;
use App\Models\oder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class DailyCommissionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* //old function
    public function daily_commission()
    {
        //modification function
        //
         //after 7 days
         $date = date('Y-m-d H:i:s');
         $date = strtotime($date);
         $date = strtotime("-9 day", $date);
         $new_date = date('Y-m-d H:i:s', $date);
 
 
         // getting not complete 1:3 oders
         $oders = DB::table('oders')->where('status', '=', 1)->where('daily_commission', '=', 1)->whereColumn('total_package_earnings', '<', 'max_value')->get();
         
         $daily_points = 0;
         foreach($oders as $oder){
           $register_node_date = DB::table('shadow_maps')->where('status', '=', 1)->where('user_id',$oder->user_id)->first(); 
           //if need check top 7 nodes and getting direct sales 2 double of daily commission
           $direct_sale_count=DB::table('users')
            ->join('oders','users.id','=','oders.user_id')
            ->where('users.parent',$oder->user_id)
            ->where('oders.active_date', '>=', $register_node_date->created_at)
            ->whereIn('oders.status', ['1', '2'])
            ->select('users.id')
            ->count();
            
            if($direct_sale_count > 1){
                $daily_points = ((master_data()->daily *2) * $oder->product_value);
              
            }else{
                $daily_points = (master_data()->daily * $oder->product_value);  
            }

           $user_oder_count = DB::table('user_oder_counts')->where('user_id',$oder->user_id)->first();
           
          if($user_oder_count->count < 4  && $user_oder_count->count > 0){
        
            
           
       
           if( $daily_points >= ( $oder->max_value - $oder->total_package_earnings ) ){
             
             $new_daily_points = ($oder->max_value - $oder->total_package_earnings);
 
             $node_check = shadow_map_node_check($oder->user_id);
 
             //checking 7 admin heads
             

             if(admin_head_check($node_check->id) == 1){
             
             }else{
            $daily_commission_logs = new daily_commission_log;
            $daily_commission_logs->user_id = $oder->user_id;
            $daily_commission_logs->amount = $new_daily_points ;
            $daily_commission_logs->oder_id = $oder->id;
            $daily_commission_logs->save();
 
             $oder_update = oder::find($oder->id);
             $currentuserearningmax = $oder_update->max_value;
             $current_user_id = $oder_update->user_id ;
             $oder_update->status = 2;
             $oder_update->total_package_earnings = $oder->max_value;
             $oder_update->save();
             
             $oder_update = shadow_map::find($node_check->id);
             $oder_update->status = 0;
             $oder_update->save();

             $description = 'Daily Commission';
             $old_cash_wallet = DB::table('cash_wallets')->where('user_id',$current_user_id)->first();
             $old_product_wallet = DB::table('product_wallets')->where('user_id',$current_user_id)->first();

             $expect_product_val = ($currentuserearningmax / 3) ;
             $current_product_val = $old_product_wallet->wallet_balance;
             $fixed_product_wallet_val = $expect_product_val - $current_product_val;
             $fixed_cash_wallet_val = $new_daily_points - $fixed_product_wallet_val;
             $spill = 1;

             $currentorderid=0;
             $reference_oder_id = 0;
             // 1/3 product wallet
             product_wallet_update($fixed_product_wallet_val,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_product_wallet,$spill);
       
             // 2/3 cash wallet
             cash_wallet_update($fixed_cash_wallet_val,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_cash_wallet,$spill);
             }
             
             
         }else{
            
            $node_check = shadow_map_node_check($oder->user_id);

            if(admin_head_check($node_check->id) == 1){
             
            }else{
             
            
            
             $oder_update = oder::find($oder->id);
             $currentuserearningmax = $oder_update->max_value;
             $current_user_id = $oder_update->user_id ;
             $oder_update->total_package_earnings = $daily_points;
             $oder_update->save(); 
       
             $oder_update = oder::find($oder->id);
             $oder_update->status = 1;
             $oder_update->total_package_earnings = ($oder->total_package_earnings + $daily_points);
             $oder_update->save();
       
             $daily_commission_logs = new daily_commission_log;
             $daily_commission_logs->user_id = $oder->user_id;
             $daily_commission_logs->amount = $daily_points ;
             $daily_commission_logs->oder_id = $oder->id;
             $daily_commission_logs->save();
       

             $description = 'Daily Commission';
             $old_cash_wallet = DB::table('cash_wallets')->where('user_id',$current_user_id)->first();
             $old_product_wallet = DB::table('product_wallets')->where('user_id',$current_user_id)->first();
             $spill = 0;
             $currentorderid = '0';
             $reference_oder_id= '0';
             // 1/3 product wallet
             product_wallet_update($daily_points,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_product_wallet,$spill);
       
             // 2/3 cash wallet
             cash_wallet_update($daily_points,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_cash_wallet,$spill);
            }
             
         }

        }else{
            continue;
        }
           
         
       
         }
        alert()->success('Success','Daily Commission Shared Successfully!');
        return redirect()->route('admin');
        
    }*/


    // new upgrade
    
    public function daily_commission()
    {
        //modification function
        //
         //after 7 days
         $date = date('Y-m-d H:i:s');
         $date = strtotime($date);
         $date = strtotime("-9 day", $date);
         $new_date = date('Y-m-d H:i:s', $date);
 
        $current_date = Carbon::now()->toDateTimeString();
         // getting not complete 1:3 oders
         $oders = DB::table('oders')->where('status', '=', 1)->where('daily_commission', '=', 1)->whereColumn('total_package_earnings', '<', 'max_value')->get();

         // getting 24 hourse
        $currentDate = Carbon::now();
        $startRange = $currentDate->copy()->subDay()->setHour(9)->setMinute(0)->setSecond(0); // Previous day at 9:00 AM
        $endRange = $currentDate->setHour(9)->setMinute(0)->setSecond(0); // Current day at 9:00 AM
       // Log::info('Date'.' '.$currentDate.' '.$startRange.' '.$endRange);

        $totalProductValue = DB::table('oders')->whereBetween('active_date', [$startRange, $endRange])->where('status', 1)->where('new_oder', 1)->sum('product_value');
        $totalProductPoint = DB::table('oders')->where('status', 1)->where('new_oder', 1)->sum('share_point');
        

         
         
         $daily_points = 0;
         foreach($oders as $oder){
           $register_node_date = DB::table('shadow_maps')->where('status', '=', 1)->where('user_id',$oder->user_id)->first(); 
           
           

        //new oders check and commission generate new logic
           if($oder->new_oder == 1){
             $team_share = 0;
             
            if (!empty($oder->srr_number)) {
                
                $totalSRSProductValue = DB::table('oders')->whereBetween('active_date',[$startRange, $endRange])->where('status', 1)->where('new_oder', 1)->where('srr_number', $oder->srr_number)->sum('product_value');
                
                $totalSRSProductPoint = DB::table('oders')->where('status', 1)->where('new_oder', 1)->where('srr_number', $oder->srr_number)->sum('share_point');
                
                $team_share =  (($oder->share_point * 0.2) / $totalSRSProductPoint) * $totalSRSProductValue;
               //  Log::info('Team share'.' '.$oder->share_point.' '.$totalSRSProductPoint.' '.$totalSRSProductValue);
                DB::table('team_share_log')->insert([
                    'user_id' => $oder->user_id,
                    'oder_id' => $oder->id,
                    'srs_number' => $oder->srr_number,
                    'team_share_value' => $team_share,
                ]);
        
            } 
            
                $globle_share = (($oder->share_point * 0.2) / $totalProductPoint) * $totalProductValue;
               // Log::info('Globe share'.' '.$oder->share_point.' '.$totalProductPoint.' '.$totalProductValue);
                 DB::table('globle_share_log')->insert([
                    'user_id' => $oder->user_id,
                    'oder_id' => $oder->id,
                    'globle_share_value' => $globle_share,
                ]);
                $daily_points = $globle_share + $team_share;
            
           }else{
            //direct sale count
             $direct_sale_count=DB::table('users')
            ->join('oders','users.id','=','oders.user_id')
            ->where('users.parent',$oder->user_id)
            ->where('oders.active_date', '>=', $register_node_date->created_at)
            ->whereIn('oders.status', ['1', '2'])
            ->select('users.id')
            ->count();
            
            
            if($direct_sale_count > 1){
                $daily_points = ((master_data()->daily *2) * $oder->product_value);
              
            }else{
                $daily_points = (master_data()->daily * $oder->product_value);  
            }

           }

           
           
           
           
            $user_oder_count = DB::table('user_oder_counts')->where('user_id',$oder->user_id)->first();
           
          if($user_oder_count->count < 4  && $user_oder_count->count > 0){
        
            
           
       
           if( $daily_points >= ( $oder->max_value - $oder->total_package_earnings ) ){
             
             $new_daily_points = ($oder->max_value - $oder->total_package_earnings);
 
             $node_check = shadow_map_node_check($oder->user_id);
 
             //checking 7 admin heads
             

             if(admin_head_check($node_check->id) == 1){
             
             }else{
            $daily_commission_logs = new daily_commission_log;
            $daily_commission_logs->user_id = $oder->user_id;
            $daily_commission_logs->amount = $new_daily_points ;
            $daily_commission_logs->oder_id = $oder->id;
            $daily_commission_logs->save();
 
             $oder_update = oder::find($oder->id);
             $currentuserearningmax = $oder_update->max_value;
             $current_user_id = $oder_update->user_id ;
             $oder_update->status = 2;
             $oder_update->total_package_earnings = $oder->max_value;
             $oder_update->save();
             
             $oder_update = shadow_map::find($node_check->id);
             $oder_update->status = 0;
             $oder_update->save();

             $description = 'Daily Commission';
             $old_cash_wallet = DB::table('cash_wallets')->where('user_id',$current_user_id)->first();
             $old_product_wallet = DB::table('product_wallets')->where('user_id',$current_user_id)->first();

             $expect_product_val = ($currentuserearningmax / 3) ;
             $current_product_val = $old_product_wallet->wallet_balance;
             $fixed_product_wallet_val = $expect_product_val - $current_product_val;
             $fixed_cash_wallet_val = $new_daily_points - $fixed_product_wallet_val;
             $spill = 1;

             $currentorderid=0;
             $reference_oder_id = 0;

             //Log::info('if - '.$daily_points.'  '.$oder->user_id);
             // 1/3 product wallet
             product_wallet_update($fixed_product_wallet_val,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_product_wallet,$spill);
       
             // 2/3 cash wallet
             cash_wallet_update($fixed_cash_wallet_val,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_cash_wallet,$spill);
             }
             
             
         }else{
            
            $node_check = shadow_map_node_check($oder->user_id);
                if(!empty($node_check)){
                if(admin_head_check($node_check->id) == 1){
                
                }else{
                
                
                
                $oder_update = oder::find($oder->id);
                $currentuserearningmax = $oder_update->max_value;
                $current_user_id = $oder_update->user_id ;
                $oder_update->total_package_earnings = $daily_points;
                $oder_update->save(); 
        
                $oder_update = oder::find($oder->id);
                $oder_update->status = 1;
                $oder_update->total_package_earnings = ($oder->total_package_earnings + $daily_points);
                $oder_update->save();
        
                $daily_commission_logs = new daily_commission_log;
                $daily_commission_logs->user_id = $oder->user_id;
                $daily_commission_logs->amount = $daily_points ;
                $daily_commission_logs->oder_id = $oder->id;
                $daily_commission_logs->save();
        

                $description = 'Daily Commission';
                $old_cash_wallet = DB::table('cash_wallets')->where('user_id',$current_user_id)->first();
                $old_product_wallet = DB::table('product_wallets')->where('user_id',$current_user_id)->first();
                $spill = 0;
                $currentorderid = '0';
                $reference_oder_id= '0';

                //Log::info('Else - '.$daily_points.'  '.$oder->user_id);
                // 1/3 product wallet
                product_wallet_update($daily_points,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_product_wallet,$spill);
        
                // 2/3 cash wallet
                cash_wallet_update($daily_points,$oder->user_id,$currentorderid,$reference_oder_id,$description,$old_cash_wallet,$spill);
                }
            }
            
             
         }

        }else{
            continue;
        }
           
         
       
         }
        alert()->success('Success','Daily Commission Shared Successfully!');
        return redirect()->route('admin');
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function daily_commission_status(Request $request,$id){
         $role=Auth::user()->role;
        if($role==1 || $role==2){
           
        $oder_data = DB::table('oders')->where('id',$id)->first();
        return view('oderModule.daily_commission_status', compact('oder_data'));
        }
    }


    public function daily_commission_status_change(Request $request) {
        $order_update = DB::table('oders')->where('id', $request->oder_id)->update([
            'daily_commission' => $request->oder_status
        ]);
        
        if ($order_update) {
            // Assuming you're using sweetalert2, you can create a success alert like this
            Alert::success('Success', 'Daily Commission Status Change Successfully!')->autoclose(3000);
            return redirect()->route('all-oders');
        } else {
            // Handle the case where the update fails (e.g., invalid order_id)
            return redirect()->back()->with('error', 'Failed to update Daily Commission Status.');
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\daily_commission_log  $daily_commission_log
     * @return \Illuminate\Http\Response
     */
    public function show(daily_commission_log $daily_commission_log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\daily_commission_log  $daily_commission_log
     * @return \Illuminate\Http\Response
     */
    public function edit(daily_commission_log $daily_commission_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\daily_commission_log  $daily_commission_log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, daily_commission_log $daily_commission_log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\daily_commission_log  $daily_commission_log
     * @return \Illuminate\Http\Response
     */
    public function destroy(daily_commission_log $daily_commission_log)
    {
        //
    }
}
