<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
use App\Models\oder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class DailyCommissionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailycommission:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Commission Calculation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

       /*

           Write your database logic we bellow:

           Item::create(['name'=>'hello new']);

        */
        // getting not complete 1:3 oders
        $oders = DB::table('oders')->where('status', '=', 1)->whereColumn('total_package_earnings', '<', 'max_value')->get()->toArray();
 
        $daily_points = 0;
        foreach($oders as $oder){
      
          //if need check top 7 nodes and getting direct sales 2 double of daily commission
          
          $daily_points = (master_data()->daily * $oder->product_value);
          
      
          if( $daily_points >= ( $oder->max_value - $oder->total_package_earnings ) ){
            
            $new_daily_points = ($oder->max_value - $oder->total_package_earnings);
      
            
           
            $daily_commission_logs = new daily_commission_log;
            $daily_commission_logs->user_id = $oder->user_id;
            $daily_commission_logs->amount = $new_daily_points ;
            $daily_commission_logs->oder_id = $oder->id;
            $daily_commission_logs->save();
      
            $node_check = shadow_map_node_check($oder->user_id);
      
            $oder_update = oder::find($oder->id);
            $oder_update->status = 2;
            $oder_update->total_package_earnings = $oder->max_value;
            $oder_update->save();
            
            $oder_update = shadow_map::find($node_check->id);
            $oder_update->status = 0;
            $oder_update->save();
      
            // 1/3 product wallet
            product_wallet_update($new_daily_points,$oder->user_id,$oder->user_id,$oder->user_id);
      
            // 2/3 cash wallet
            cash_wallet_update($new_daily_points,$oder->user_id,$oder->user_id,$oder->user_id);
            
        }else{
      
           
            $oder_update = oder::find($oder->id);
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
      
            // 1/3 product wallet
            product_wallet_update($daily_points,$oder->user_id,$oder->user_id,$oder->user_id);
      
            // 2/3 cash wallet
            cash_wallet_update($daily_points,$oder->user_id,$oder->user_id,$oder->user_id);
            
      
        }
          
        
      
        }
        
    }
}
