<?php

namespace App\Http\Controllers;

use App\Models\withdrawal;
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
        if($role==0){
            return view('withdrawalModule.index');
        }
    }

    public function cash()
    {
        $role = Auth::user()->role;
        if($role==0){
            return view('withdrawalModule.cash');
        }
    }

    public function p2p()
    {
        $role = Auth::user()->role;
        if($role==0){
            return view('withdrawalModule.p2p');
        }
    }

    public function p2p_trans(Request $request)
    {
        $role = Auth::user()->role;
        if($role==0){
            $request->validate([
                'request_user_id' => 'required',
                'request_amount' => 'required',     
            ]);
    
            DB::table('p2p_transection')->insert(
                ['user_id' => Auth::user()->id, 'request_user_id' => $request->request_user_id ,'request_amount'=>$request->request_amount,'status'=>0]
            );
         
    
            return redirect()->route('wallet')->with('success','P2P Request Send Success.');
            
        }
    }

    public function cash_trans(Request $request)
    {

        $fee = $request->request_amount* master_data()->cash;
        $tranfer_amount = $request->request_amount - $fee;
        $role = Auth::user()->role;
        if($role==0){
            $request->validate([
                'request_amount' => 'required',     
            ]);
    
            DB::table('withdrawals')->insert(
                ['user_id' => Auth::user()->id,'request_amount'=>$request->request_amount,'company_fee'=>$fee,'tranfer_amount'=>$tranfer_amount,'status'=>0]
            );

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
        return redirect('wallet')->with('success', 'p2p Approved Successfully!');
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
