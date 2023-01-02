<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $role=Auth::user()->role;
            if($role==1 || $role == 2){  
                $data = DB::table('products')->get();        
                return view('productModule.index',compact('data'));
            }
            if($role==0){
                $data =DB::table('oders')
                ->join('products', 'oders.product_id', '=', 'products.id')
                ->where('oders.user_id', '=', Auth::user()->id)
                ->get();        
                return view('productModule.index',compact('data'));
            }
        }


        
        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function create()
        {
            
                return view('productModule.create');
            
      
        }
        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        public function store(Request $request)
        {
        $request->validate([
        'product_name' => 'required',
        'product_value' => 'required',
        'product_category' => 'required',
        'product_duration' => 'required',
        'product_description' => 'required',
        'product_image' => 'required',
        'product_status' => 'required',
        ]);
        $product = new product();
        $product->product_name = $request->product_name;
        $product->product_value = $request->product_value;
        $product->product_category = $request->product_category;
        $product->product_duration = $request->product_duration;
        $product->product_description = $request->product_description;
        ;
        if($request->file('product_image')){
            $file= $request->file('product_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/products/img'), $filename);
            $product->product_image = $filename;
        }
        
        $product->product_status = $request->product_status;
        $product->save();
        Alert::Alert('Success', 'Package has been created successfully.')->persistent(true,false);
        return redirect()->route('product.index');
        }
        /**
        * Display the specified resource.
        *
        * @param  \App\product  $product
        * @return \Illuminate\Http\Response
        */
        public function show(product $product)
        {
        return view('productModule.show',compact('product'));
        } 
        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Company  $product
        * @return \Illuminate\Http\Response
        */
        public function edit(Request $product,$id)
        {
            $role=Auth::user()->role;
            if($role==2){
                $product = DB::table('products')->where('id', $id)->get();
                return view('productModule.edit',compact('product','id'));
            }
            
        }
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\product  $product
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
        $request->validate([
            'product_name' => 'required',
            'product_value' => 'required',
            'product_category' => 'required',
            'product_duration' => 'required',
            'product_description' => 'required',
            'product_status' => 'required',
        ]);
        $product = product::find($id);
        $product->product_name = $request->product_name;
        $product->product_value = $request->product_value;
        $product->product_category = $request->product_category;
        $product->product_duration = $request->product_duration;
        $product->product_description = $request->product_description;
        ;
        if($request->file('product_image')){
            $file= $request->file('product_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/products/img'), $filename);
            $product->product_image = $filename;
        }
        
        $product->product_status = $request->product_status;
        $product->save();
        Alert::Alert('Success', 'Package has been updated successfully.')->persistent(true,false);
        return redirect()->route('product.index');
        }
        
        public function destroy(product $product)
        {
        $product->delete();
        Alert::Alert('Success', 'Package has been deleted successfully.')->persistent(true,false);
        return redirect()->route('product.index');
        }

        

        
}
