<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
class ReportController extends Controller
{
    //

    public function users_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){
            $data = DB::table('users')->where('role',0)->paginate(10);;
            
        } 
        return view('reportModule.user',compact('data'));
    }

    public function users_report_daily()
    {
        $role=Auth::user()->role;
        if($role==0){
            $binary_data = DB::table('binary_commission_logs')->where('user_id',Auth::user()->id)->select('created_at', 'amount')->get();
            $level_data = DB::table('level_commission_logs')->where('user_id',Auth::user()->id)->select('created_at', 'amount')->get();
            $direct_data = DB::table('direct_commission_logs')->where('user_id',Auth::user()->id)->select('created_at', 'amount')->get();
            $daily_data = DB::table('daily_commission_logs')->where('user_id',Auth::user()->id)->select('created_at', 'amount')->get();
        } 
        return view('reportModule.user_daily',compact('binary_data','level_data','direct_data','daily_data'));
    }


    public function binary_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('binary_commission_logs')
            ->join('users', 'users.id', '=', 'binary_commission_logs.user_id')
            ->where('binary_commission_logs.amount', '>', 0) // Add condition to filter out rows with amount 0
            ->orderBy('binary_commission_logs.created_at', 'desc')
            ->select('users.id as uid', 'users.fname', 'users.lname', 'binary_commission_logs.*')
            ->get();

            return view('reportModule.binary', compact('data'));
        }
    }

    public function direct_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('direct_commission_logs')
            ->join('users', 'users.id', '=', 'direct_commission_logs.user_id')
            ->where('direct_commission_logs.amount', '>', 0)
            ->orderBy('direct_commission_logs.created_at', 'desc')
            ->select('users.id as uid','users.fname','users.lname','direct_commission_logs.*')
            ->get();
            return view('reportModule.direct',compact('data'));
        }
    }

    public function level_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('level_commission_logs')
            ->join('users', 'users.id', '=', 'level_commission_logs.user_id')
            ->orderBy('level_commission_logs.created_at', 'desc')
            ->select('users.id as uid','users.fname','users.lname','level_commission_logs.*')
            ->get();
            return view('reportModule.level',compact('data'));
        }
    }


    public function daily_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('daily_commission_logs')
            ->join('users', 'users.id', '=', 'daily_commission_logs.user_id')
            ->orderBy('daily_commission_logs.created_at', 'desc')
            ->select('users.id as uid','users.fname','users.lname','daily_commission_logs.*')
            ->paginate(200);
            return view('reportModule.daily',compact('data'));
        }
    }


    public function commission_reports(){
        $role=Auth::user()->role;
        if($role==1){

            $data = DB::table('daily_commission_logs')
            ->leftJoin('binary_commission_logs', 'binary_commission_logs.user_id', '=', 'daily_commission_logs.user_id')
            ->leftJoin('direct_commission_logs', 'direct_commission_logs.user_id', '=', 'daily_commission_logs.user_id')
            ->leftJoin('level_commission_logs', 'level_commission_logs.user_id', '=', 'daily_commission_logs.user_id')
            ->where('daily_commission_logs.user_id',Auth::user()->id)
            ->orderBy('daily_commission_logs.created_at', 'desc')
            ->select('direct_commission_logs.amount as damount','binary_commission_logs.amount as bamount','daily_commission_logs.amount as diamount','level_commission_logs.amount as lamount')
            ->get();
            return view('reportModule.commission',compact('data'));
        }
    }

    public function future_plan_sales()
    {

        return view('reportModule.future_plan_sales');
    }
 
    public function future_plan_sales_records (Request $request)
    {
        if ($request->ajax()) {
 
            if ($request->input('start_date') && $request->input('end_date')) {
 
                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));
 
                if ($end_date->greaterThan($start_date)) {
                    $students  = User::select('users.id as user_id','users.sri_number','users.fname', 'users.lname', 'users.email', 'oders.srr_number', 'users.created_at')
                    ->join('oders', 'users.id', '=', 'oders.user_id')
                    ->whereColumn('oders.srr_number', '=', 'users.srr_number')
                    ->whereBetween('users.created_at', [$start_date, $end_date])
                    ->groupBy('users.sri_number','users.fname', 'users.lname', 'users.email', 'oders.srr_number', 'users.created_at')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Real Cash\' THEN 1 END) AS RCT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SFT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Product Wallet\' THEN 1 END) AS PWT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WCT')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 THEN 1 END) AS package1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 THEN 1 END) AS package2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 THEN 1 END) AS package3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 THEN 1 END) AS package4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC4')
                    ->get();

                } else {
                    $students  = User::select('users.id as user_id','users.sri_number','users.fname', 'users.lname', 'users.email', 'oders.srr_number', 'users.created_at')
                    ->join('oders', 'users.id', '=', 'oders.user_id')
                    ->whereColumn('oders.srr_number', '=', 'users.srr_number')
                    ->groupBy('users.sri_number','users.fname', 'users.lname', 'users.email', 'oders.srr_number', 'users.created_at')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Real Cash\' THEN 1 END) AS RCT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SFT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Product Wallet\' THEN 1 END) AS PWT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WCT')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 THEN 1 END) AS package1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 THEN 1 END) AS package2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 THEN 1 END) AS package3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 THEN 1 END) AS package4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC4')
                    ->get();
                }
            } else {
                $students = User::select('users.id as user_id','users.sri_number','users.fname', 'users.lname', 'users.email', 'oders.srr_number', 'users.created_at')
                ->join('oders', 'users.id', '=', 'oders.user_id')
                ->whereColumn('oders.srr_number', '=', 'users.srr_number')
                ->groupBy('users.sri_number','users.fname', 'users.lname', 'users.email', 'oders.srr_number', 'users.created_at')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Real Cash\' THEN 1 END) AS RCT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SFT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Product Wallet\' THEN 1 END) AS PWT')
                    ->selectRaw('COUNT(CASE WHEN oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WCT')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 THEN 1 END) AS package1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 1 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC1')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 THEN 1 END) AS package2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 2 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC2')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 THEN 1 END) AS package3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 3 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC3')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 THEN 1 END) AS package4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Real Cash\' THEN 1 END) AS RC4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Sponser Funds\' THEN 1 END) AS SF4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Product Wallet\' THEN 1 END) AS PW4')
                    ->selectRaw('COUNT(CASE WHEN oders.product_id = 4 AND oders.payment_method = \'Wallet + Cash\' THEN 1 END) AS WC4')
                ->get();
            }
 
            return response()->json([
                'students' => $students
            ]);
        } else {
            abort(403);
        }
    }
}
