<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\oder;
use App\Models\user_oder_count;
use App\Models\ProductBuyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(){
        $role=Auth::user()->role;
        if($role==0){
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
        if($role==0){
           
            $buy_requests = DB::table('product_buy_requests')->where('id', $id)->get(); 
            
            return view('payModule.user_requests_edit',compact('buy_requests','id'));
        }
    }

    public function update(Request $request, $id){

        $package = ProductBuyRequest::find($id);
        $package->status = 1;
        $package->save();

        

        return redirect('p2p')->with('success', 'p2p Approved Successfully!');
   
    }
}
