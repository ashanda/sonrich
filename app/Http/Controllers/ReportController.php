<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    //
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
        //
    }
}
