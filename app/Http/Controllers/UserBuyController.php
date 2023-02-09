<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\oder;
use App\Models\user_oder_count;
use App\Models\ProductBuyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class UserBuyController extends Controller
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
            $data =DB::table('products')->get();
                return view('productModule.buyproduct',compact('data'));
            
        }

        if($role==0){
            $data =DB::table('products')->get();
                return view('productModule.buyproduct',compact('data'));
            
        }
    }

    public function real_cash(Request $request){
        $oder = new oder;
        $oder->user_id = Auth::user()->id;
        $oder->product_id = $request->product_id;
        $oder->product_value = $request->product_price;
        $oder->product_point = $request->product_point;
        $oder->payment_method = 'Real Cash';
        $oder->cash_pay_amount = $request->product_price;
        $oder->wallet_pay_amount = 0;
        $oder->max_value = $request->product_price*3;
        $oder->status = $request->status;
        $oder->save();


        $oder_counts_detils = DB::table('user_oder_counts')->where('user_id', Auth::user()->id)->first();
        if($oder_counts_detils != NULL){
            $oder_counts_detils->count;
            $oder_count = $oder_counts_detils->count;
        }else{
            $oder_count = 0;
        }
        $oder_id = $oder->id;
        
        
         $oder_counts = DB::table('user_oder_counts')->updateOrInsert(
            ['user_id'=>Auth::user()->id],
            ['oder_id'=> $oder_id,
            'count'=>$oder_count+1]);
    
        return redirect('buy_product')->with('success', 'Product buy Successfully wait for admin approve!');
    }

    public function sponsor_funds(Request $request){
        $oder = new ProductBuyRequest;
        $oder->user_id = Auth::user()->id;
        $oder->sponsor_id = $request->sponsor_id;
        $oder->product_id = $request->product_id;
        $oder->request_amount = $request->product_price;
        $oder->status = $request->status;
        $oder->save();

        $oder_counts_detils = DB::table('user_oder_counts')->where('user_id', Auth::user()->id)->first();
        if($oder_counts_detils != NULL){
            $oder_counts_detils->count;
            $oder_count = $oder_counts_detils->count;
        }else{
            $oder_count = 0;
        }
        $oder_id = $oder->id;
        
        
         $oder_counts = DB::table('user_oder_counts')->updateOrInsert(
            ['user_id'=>Auth::user()->id],
            ['oder_id'=> $oder_id,
            'count'=>$oder_count+1]);

        return redirect('buy_product')->with('success', 'Waiting for admins approval.');
        
    }

    public function wallet_and_cash(Request $request){

        $product_wallet = DB::table('product_wallets')->where('user_id', Auth::user()->id)->first();
        $cash_pay_amount = $request->product_price - $product_wallet->wallet_balance;
        $oder = new oder;
        $oder->user_id = Auth::user()->id;
        $oder->product_id = $request->product_id;
        $oder->product_value = $request->product_price;
        $oder->wallet_pay_amount = $product_wallet->wallet_balance;
        $oder->product_point = $request->product_point;
        
        $oder->cash_pay_amount = $cash_pay_amount;
        $oder->payment_method = 'Wallet + Cash';
        $oder->max_value = $request->product_price*3;
        $oder->status = $request->status;
        $oder->save();

        $product_wallet_balance_detils = DB::table('product_wallets')->where('user_id', Auth::user()->id)->first();
        
        $new_product_wallet_balance = DB::table('product_wallets')->updateOrInsert(
                                                ['user_id'=>Auth::user()->id],
                                                ['wallet_balance'=> 0]);

        $user_id  =  Auth::user()->id ; 
        $amount = $request->product_price;
        $oder_id = $oder->id;
        $reference_oder_id = 0;
        $trx_direction = 'Out';
        $description = 'product wallet buy';
        product_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description); 

        return redirect('buy_product')->with('success', 'You have place the order successfully. Waiting for admins approval.');
    }

    public function product_wallet(Request $request){
        
        $oder = new oder;
        $oder->user_id = Auth::user()->id;
        $oder->product_id = $request->product_id;
        $oder->wallet_pay_amount = $request->product_price;
        $oder->cash_pay_amount = 0;
        $oder->product_value = $request->product_price;
        $oder->product_point = $request->product_point;
        $oder->payment_method = 'Product Wallet';
        $oder->max_value = $request->product_price*3;
        $oder->status = $request->status;
        $oder->save();
        
        
        $product_wallet_balance_detils = DB::table('product_wallets')->where('user_id', Auth::user()->id)->first();
        
        $new_product_wallet_balance = DB::table('product_wallets')->updateOrInsert(
                                                ['user_id'=>Auth::user()->id],
                                                ['wallet_balance'=> 0]);

        $user_id  =  Auth::user()->id ; 
        $amount = $request->product_price;
        $oder_id = $oder->id;
        $reference_oder_id = 0;
        $trx_direction = 'Out';
        $description = 'product wallet buy';
        product_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description);    
              
        return redirect('buy_product')->with('success', 'You have place the order successfully. Waiting for admins approval.');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
