<?php

namespace App\Http\Controllers;

use App\Models\oder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\shadow_map;

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
            ->select('users.id as uid','users.fname','users.sri_number','users.lname','oders.*')

            ->get();
            return view('oderModule.index',compact('data'));
        }

        if($role==0){

            $data = DB::table('oders')
            ->join('users', 'users.id', '=', 'oders.user_id')
            
            ->where('users.id',Auth::user()->id)
            ->orderBy('oders.created_at', 'asc')
            ->select('users.id as uid','users.fname','users.sri_number','users.lname','oders.*')

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
            ->select('users.id as uid','users.fname','users.sri_number','users.lname','oders.*')
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
        if($request->oder_status == 1){
            $request->validate([
                'oder_status' => 'required',
                'point_value' => 'required',
                'product_value' => 'required',
            ]);
    
            
    
            $child_id = $request->user_id;
           
            //user pyrmide positions passing child id and set coodinate and save db shadow maps 
            
           
            $product_value = $request->product_value;
    
            

            $package = oder::find($id);
            $package->status = $request->oder_status;
            $package->active_date = date('Y-m-d H:i:s');
            
    
    
            $reference_oder_id = $package->id;  
           // Call Commission helpers
           if(user_positioning($child_id) == 1){


                //Binary points current user package
                $binary_points = $request->point_value;
                    
                //Direct 10%
                $direct_point = (master_data()->direct * $product_value);

                //Level 1%
                $level_points = (master_data()->level * $product_value);

                
            ShadowMapCommissions($child_id, $binary_points, $level_points, $direct_point, $reference_oder_id);
            user_oder_count_update($child_id,$reference_oder_id);
    
           }
           
            
           
           $package->save();
           Alert::Alert('Success','Oder Approved Successfully!');
           return redirect()->route('oders.index');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\oder  $oder
     * @return \Illuminate\Http\Response
     */
    public function destroy(oder $oder)
    {
        
        $role=Auth::user()->role;
        $get_oder_user_id = DB::table('oders')->where('id',$oder->id)->first();
        $get_oder_count_id = DB::table('user_oder_counts')->where('user_id',$get_oder_user_id->user_id)->first();
        
        if($role==1 || $role==2){
            $oder->delete();
            DB::table('user_oder_counts')->delete($get_oder_count_id->id);
            Alert::Alert('Success', 'Oder has been deleted successfully.')->persistent(true,false); 
            return redirect()->route('oders.index');
        }
    }
}
