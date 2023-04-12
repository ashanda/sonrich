<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\oder;
use App\Models\user_oder_count;
use App\Models\ProductBuyRequest;
use App\Models\cash_wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(){
        $role=Auth::user()->role;
        if($role==0 || $role==1){
            $data =DB::table('product_buy_requests')
                    ->join('users', 'users.id', '=', 'product_buy_requests.sponsor_id')
                    ->where('users.id', '=', Auth::user()->id)
                    ->where('product_buy_requests.status', '=', 0)
                    ->select('product_buy_requests.id','users.fname','users.lname','product_buy_requests.request_amount')
                    ->get();
                return view('payModule.user_requests',compact('data'));
            
        }
    }

    public function edit(Request $buy_requests,$id)
    {
        $role=Auth::user()->role;
        if($role==0 || $role==1){
           
            $buy_requests = DB::table('product_buy_requests')->where('id', $id)->get(); 
            
            return view('payModule.user_requests_edit',compact('buy_requests','id'));
        }
    }

    public function update(Request $request, $id){

        $package = ProductBuyRequest::find($id);
        

        $last_cash_wallet_rec = cash_wallet($package->sponsor_id);
        $request_val = floatval($request->requset_value);

if( $last_cash_wallet_rec->wallet_balance >= $request_val ){

    $package->status = 1;
    $package->save();

    $wallet_rec = cash_wallet::find($last_cash_wallet_rec->id);  
    $wallet_rec->wallet_balance  = $last_cash_wallet_rec->wallet_balance - $request_val;
    $wallet_rec->save();

    

    $user_id  =  $package->user_id; 
    $amount = $package->request_amount;
    $oder_id = $package->request_user_id;
    $reference_oder_id ='-1';
    $trx_direction = 'Out';
    $description = 'Friends withdraw';

    cash_wallet_log($user_id,$amount,$oder_id,$reference_oder_id,$trx_direction,$description); 
    
    $product_data = find_product($package->product_id);

    $oder = new oder;
    $oder->user_id = $package->user_id;

    if($package->srr_number != null) {
        $oder->srr_number = $package->srr_number;
    }
    
    $oder->product_id = $product_data->id;
    $oder->product_value = $product_data->product_price;
    $oder->product_point = $product_data->point_value;
    $oder->payment_method = 'Sponser Funds';
    $oder->cash_pay_amount = $product_data->product_price;
    $oder->wallet_pay_amount = 0;
    $oder->max_value = $product_data->product_price*3;
    $oder->status = '0';
    $oder->save();

    Alert::Alert('Success','Approved Successfully!');
    return redirect('friend_request');

}else{
    Alert::Alert('Error','Your Cash Wallet Value Not Enough For This!');
    return redirect('friend_request');
}
        
   
    }
}
