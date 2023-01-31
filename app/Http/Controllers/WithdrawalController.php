<?php

namespace App\Http\Controllers;

use App\Models\withdrawal;
use App\Models\cash_wallet;
use App\Models\p2p;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        if($role==0 || $role==1){
            return view('withdrawalModule.index');
        }
    }

    public function cash()
    {
        $role = Auth::user()->role;
        if($role==0 || $role==1){
            return view('withdrawalModule.cash');
        }
    }

    public function p2p()
    {
        $role = Auth::user()->role;
        if($role==0 || $role==1){
            return view('withdrawalModule.p2p');
        }
    }

    public function p2p_trans(Request $request)
    {
        $role = Auth::user()->role;
        if($role==0 || $role==1){
            $request->validate([
                'request_user_id' => 'required',
                'request_amount' => 'required',     
            ]);
    
            DB::table('p2p_transection')->insert(
                ['user_id' => Auth::user()->id, 'request_user_id' => $request->request_user_id ,'request_amount'=>$request->request_amount,'status'=>0]
            );
            
            $last_cash_wallet = cash_wallet(Auth::user()->id);
            $wallet = cash_wallet::find($last_cash_wallet->id);  
            $wallet->hold_amount  = ($last_cash_wallet->hold_amount + $request->request_amount);
            $wallet->wallet_balance  = ($last_cash_wallet->wallet_balance - $request->request_amount);
            $wallet->save();
            
            return redirect()->route('wallet')->with('success','P2P Request Send Success.');
            
        }
    }

    public function cash_trans(Request $request)
    {

        $fee = $request->request_amount* master_data()->cash;
        $tranfer_amount = $request->request_amount - $fee;
        $role = Auth::user()->role;
        if($role==0 || $role==1){
            $request->validate([
                'request_amount' => 'required',     
            ]);
    
            DB::table('withdrawals')->insert(
                ['user_id' => Auth::user()->id,'request_amount'=>$request->request_amount,'company_fee'=>$fee,'tranfer_amount'=>$tranfer_amount,'status'=>0]
            );
            $last_cash_wallet = cash_wallet(Auth::user()->id);
            $wallet = cash_wallet::find($last_cash_wallet->id);  
            $wallet->hold_amount  = $request->request_amount;
            $wallet->wallet_balance  = ($last_cash_wallet->wallet_balance - $request->request_amount);
            $wallet->save();


            

            return redirect()->route('wallet')->with('success','Cash Request Send Success.');
            
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
     * @param  \App\Models\withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(withdrawal $withdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(withdrawal $withdrawal)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $package = withdrawal::find($id);
        $package->status = 1;
        $package->save();


        $last_cash_wallet = cash_wallet($package->user_id);
        $wallet = cash_wallet::find($last_cash_wallet->id);  
        $request_val = floatval($request->request_amount);
        $wallet->hold_amount  = $package->request_amount - $request_val;
       
        $wallet->save();

        $user_id  =  $package->user_id; 
        $amount = $package->request_amount;
        $oder_id = '-1';
        $reference_oder_id = '-1';
        $trx_direction = 'Out';
        $description = 'cash withdraw';
        cash_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description); 

        return redirect('wallet')->with('success', 'Approved Successfully!');
    }

    public function update_p2p(Request $request, $id)
    {
        $package = p2p::find($id);
        $package->status = 1;
        $package->save();

        $last_cash_wallet = cash_wallet($package->user_id);
        $wallet = cash_wallet::find($last_cash_wallet->id);  
        $request_val = floatval($request->request_amount);
        $wallet->hold_amount  = $package->request_amount - $request_val;
       
        $wallet->save();

        $user_id  =  $package->user_id; 
        $amount = $package->request_amount;
        $oder_id = '-1';
        $reference_oder_id = '-1';
        $trx_direction = 'Out';
        $description = 'cash withdraw';
        cash_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description); 

        return redirect('wallet')->with('success', 'Approved Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(withdrawal $withdrawal)
    {
        //
    }
}
