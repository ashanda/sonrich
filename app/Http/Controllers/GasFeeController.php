<?php

namespace App\Http\Controllers;

use App\Models\GasFee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GasFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role=Auth::user()->role;
        if($role==0 || $role==1){

            $data = DB::table('gas_fees')
            ->join('users', 'users.id', '=', 'gas_fees.user_id')
            ->select('users.id as uid','users.fname','users.lname','gas_fees.*')
            ->get();
            return view('gasModule.index',compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gasModule.create');
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

            'user_id' => 'required',
            'gas_fee' => 'required',
            'last_earn' => 'required'
        ]);

    

        GasFee::create($request->all());

     

        return redirect()->route('gas_fee_collect.index')->with('success','Gas Fee added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GasFee  $gasFee
     * @return \Illuminate\Http\Response
     */
    public function show(GasFee $gasFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GasFee  $gasFee
     * @return \Illuminate\Http\Response
     */
    public function edit(GasFee $gasFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GasFee  $gasFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GasFee $gasFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GasFee  $gasFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(GasFee $gasFee)
    {
        //
    }
}
