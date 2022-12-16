<?php

namespace App\Http\Controllers;
use App\Models\Kyc;
use Illuminate\Http\Request;

class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kycModule.create');
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

            'uid' => 'required',
            'email' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'mobile_no_one' => 'required|numeric|digits:10',
            'mobile_no_two' => 'required|numeric|digits:10',
            'id_doc' => 'required',
            'id_doc_front' => 'required',
            'id_doc_back' => 'required',
            'country' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_number' => 'required|numeric',
            'citizen_srilanka' => 'required',
        ]);

    

        Kyc::create($request->all());

     

        return redirect()->route('products.index')

                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('kycModule.show');
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
