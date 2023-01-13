<?php

namespace App\Http\Controllers;

use App\Models\p2p;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\cash_wallet;

class P2pController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role=Auth::user()->role;
        if($role==0){
            $data =DB::table('p2p_transection')
                    ->join('users', 'users.id', '=', 'p2p_transection.request_user_id')
                    ->where('users.id', '=', Auth::user()->id)
                    ->where('p2p_transection.status', '=', 0)
                    ->select('p2p_transection.id','users.fname','users.lname','p2p_transection.request_amount')
                    ->get();
                return view('payModule.p2p_request',compact('data'));
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\Models\p2p  $p2p
     * @return \Illuminate\Http\Response
     */
    public function show(p2p $p2p)
    {
        $data =DB::table('p2p_transection')
        ->join('users', 'users.id', '=', 'p2p_transection.request_user_id')
        ->where('p2p_transection.user_id', '=', Auth::user()->id)
        ->where('p2p_transection.status', '=', 1)
        ->select('p2p_transection.id','users.fname','users.lname','p2p_transection.request_amount')
        ->get();
         return view('payModule.p2p_show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\p2p  $p2p
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $p2p,$id)
    {
        $role=Auth::user()->role;
        if($role==0){
           
            $p2p = DB::table('p2p_transection')->where('id', $id)->get(); 
            return view('payModule.p2p_request_edit',compact('p2p','id'));
        }
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\p2p  $p2p
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = p2p::find($id);
        $package->status = $request->oder_status;
        $package->save();

        $last_cash_wallet = cash_wallet($package->request_user_id);

        $wallet = cash_wallet::find($last_cash_wallet->id);  
        $request_val = floatval($request->requset_value);
        $wallet->wallet_balance  = $last_cash_wallet->wallet_balance + $request_val;
       
        $wallet->save();

        $last_cash_wallet_rec = cash_wallet($package->user_id);

        $wallet_rec = cash_wallet::find($last_cash_wallet_rec->id);  
        $request_val = floatval($request->requset_value);
        $wallet_rec->hold_amount  = $last_cash_wallet_rec->hold_amount - $request_val;
        $wallet_rec->save();

      

        $user_id  =  $package->user_id; 
        $amount = $package->request_amount;
        $oder_id = $package->request_user_id;
        $reference_oder_id ='-1';
        $trx_direction = 'Out';
        $description = 'P2P withdraw';

       cash_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description); 


        return redirect('p2p')->with('success', 'Approved Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\p2p  $p2p
     * @return \Illuminate\Http\Response
     */
    public function destroy(p2p $p2p)
    {
        //
    }
}
