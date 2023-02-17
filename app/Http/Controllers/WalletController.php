<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        $role=Auth::user()->role;
        if($role==1){

            $data = DB::table('withdrawals')
            ->join('users', 'users.id', '=', 'withdrawals.user_id')
            ->select('users.id as uid','users.fname','users.lname','withdrawals.*')
            ->get();
            return view('walletModule.index',compact('data'));
        }
        if($role==0){
            $data = DB::table('withdrawals')
            ->join('users', 'users.id', '=', 'withdrawals.user_id')
            ->select('users.id as uid','users.fname','users.lname','withdrawals.*')
            ->where('uid',Auth::user()->id)
            ->get();
            return view('walletModule.index',compact('data'));
        }
    } 
}
