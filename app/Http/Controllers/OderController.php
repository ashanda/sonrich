<?php

namespace App\Http\Controllers;

use App\Models\oder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class OderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('oders')
            ->join('users', 'users.id', '=', 'oders.user_id')
            ->where('oders.status',0)
            ->orderBy('oders.created_at', 'asc')
            ->select('users.id as uid','users.fname','users.lname','oders.*')

            ->get();
            return view('oderModule.index',compact('data'));
        }

        if($role==0){

            $data = DB::table('oders')
            ->join('users', 'users.id', '=', 'oders.user_id')
            
            ->where('users.id',Auth::user()->id)
            ->orderBy('oders.created_at', 'asc')
            ->select('users.id as uid','users.fname','users.lname','oders.*')

            ->get();
            return view('oderModule.index',compact('data'));
        }
    }

    public function all_oders()
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){

            $data = DB::table('oders')
            ->join('users', 'users.id', '=', 'oders.user_id')
            ->orderBy('oders.created_at', 'desc')
            ->select('users.id as uid','users.fname','users.lname','oders.*')
            ->get();
            return view('oderModule.all',compact('data'));
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
     * @param  \App\Models\oder  $oder
     * @return \Illuminate\Http\Response
     */
    public function show(oder $oder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\oder  $oder
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $oder,$id)
    {
        $role=Auth::user()->role;
            if($role==1 || $role==2){
                $oder = DB::table('oders')
                ->join('users', 'users.id', '=', 'oders.user_id')
                ->where('oders.id', $id)
                ->orderBy('oders.created_at', 'desc')
                ->select('users.id as uid','users.fname','users.lname','oders.*')
                ->get();
                return view('oderModule.edit',compact('oder','id'));
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\oder  $oder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'oder_status' => 'required',
            'point_value' => 'required',
            'product_value' => 'required',
        ]);

        $package = oder::find($id);
        $package->status = $request->oder_status;
        $package->save();


        $reference_oder_id = $package->id;

        $child_id = $request->user_id;
        
        //user pyrmide positions passing child id and set coodinate and save db shadow maps 
        
        
        $product_value = $request->product_value;

        //Binary points current user package
        $binary_points = $request->point_value;

        //Direct 10%
        $direct_point = (master_data()->direct * $product_value);

        //Level 1%
        $level_points = (master_data()->level * $product_value);
          
       // Call Commission helpers
       if(user_positioning($child_id) == 1){

        ShadowMapCommissions($child_id, $binary_points, $level_points, $direct_point, $reference_oder_id);

       }
       
        
       
       
        
        return redirect('oders')->with('success', 'Oder Approved Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\oder  $oder
     * @return \Illuminate\Http\Response
     */
    public function destroy(oder $oder)
    {
        //
    }
}
