<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    //

    public function users_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){
            $data = DB::table('users')->where('role',0)->get();
            
        } 
        return view('reportModule.user',compact('data'));
    }

    public function users_report_daily()
    {
        $role=Auth::user()->role;
        if($role==0){
            $binary_data = DB::table('binary_commission_logs')->where('user_id',Auth::user()->id)->get();
            $level_data = DB::table('level_commission_logs')->where('user_id',Auth::user()->id)->get();
            $direct_data = DB::table('direct_commission_logs')->where('user_id',Auth::user()->id)->get();
            $daily_data = DB::table('daily_commission_logs')->where('user_id',Auth::user()->id)->get();
        } 
        return view('reportModule.user_daily',compact('binary_data','level_data','direct_data','daily_data'));
    }


    public function binary_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('binary_commission_logs')
            ->join('users', 'users.id', '=', 'binary_commission_logs.user_id')
            ->orderBy('binary_commission_logs.created_at', 'desc')
            ->select('users.id as uid','users.fname','users.lname','binary_commission_logs.*')
            ->get();
            return view('reportModule.binary',compact('data'));
        }
    }

    public function direct_report()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('direct_commission_logs')
            ->join('users', 'users.id', '=', 'direct_commission_logs.user_id')
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
            ->get();
            return view('reportModule.daily',compact('data'));
        }
    }


    public function commission_reports(){
        $role=Auth::user()->role;
        if($role==0){

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
}
