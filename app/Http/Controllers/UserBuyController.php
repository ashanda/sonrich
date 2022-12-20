<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $data =DB::table('oders')
                ->join('products', 'oders.product_id', '=', 'products.id')
                ->where('oders.user_id', '=', Auth::user()->id)
                ->get();
                return view('productModule.buyproduct',compact('data'));
            
        }
    }

    public function real_cash($request){
        $oder = new oder;
        $oder->user_id = $request->user_id;
        $oder->product_id = $request->product_id;
        $oder->status = $request->status;
        $post->save();
        return redirect('buy_product/real_cash')->with('status', 'Blog Post Form Data Has Been inserted');
    }

    public function sponser_funds($request){
        return view('userModule.user.userHome');
    }

    public function wallet_and_cash($request){
        return view('userModule.user.userHome');
    }

    public function product_wallet($request){
        return view('userModule.user.userHome');
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
