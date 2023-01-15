<?php

namespace App\Http\Controllers;
use App\Models\Kyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class KycController extends Controller
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

            $data = DB::table('users')
            ->join('kycs', 'kycs.user_id', '=', 'users.id')
            ->orderBy('kycs.created_at', 'desc')
            ->get();
            return view('kycModule.index',compact('data'));
        }
        if($role==0){
            return view('kycModule.index');
        }
        
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

            'user_id' => 'required',
            'mobile_number1' => 'required',
            'mobile_number2' => 'required',
            'id_docs_type' => 'required',
            'id_doc_front' => 'required',
            'id_doc_back' => 'required',
            'country' => 'required',
            'address' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'bank_acount_number' => 'required',
            'citizen' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);
         $kyc = new kyc;
        if($request->file('id_doc_front')){
            $file= $request->file('id_doc_front');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('/kycs/img'), $filename);
            $kyc->id_doc_front = $filename;
            
        }
        if($request->file('id_doc_back')){
            $file= $request->file('id_doc_back');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/kycs/img'), $filename);
            $kyc->id_doc_back = $filename;
        }

        $kyc->user_id = $request->user_id;
        $kyc->mobile_number1 = $request->mobile_number1;
        $kyc->mobile_number2 = $request->mobile_number2;
        $kyc->id_docs_type = $request->id_docs_type;
        $kyc->country = $request->country;
        $kyc->address = $request->address;
        $kyc->bank_name = $request->bank_name;
        $kyc->branch_name = $request->branch_name;
        $kyc->bank_acount_number = $request->bank_acount_number;
        $kyc->citizen = $request->citizen;
        $kyc->crypto_wallet = $request->crypto_wallet;
        $kyc->status = $request->status;        
        $kyc->save();
        

     
        Alert::Alert('Success', 'KYC has been created successfully.')->persistent(true,false); 
        return redirect()->route('kyc.index');
       
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
    public function edit(Request $kyc, $id)
    {
        $role=Auth::user()->role;
        if($role==1 || $role==2){
            $kyc = kyc::find($id);
            return view('kycModule.edit',compact('kyc','id'));
        }
        if($role==0){
            $user_id = Auth::id();
            $kyc = DB::table('kycs')->where('user_id', $user_id)->first();  
            return view('kycModule.edit',compact('kyc','id'));
        }
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
        $role=Auth::user()->role;
        if($role==1 || $role==2){
            $request->validate([
                
                'status' => 'required',
                ]);
                $kyc = kyc::find($id);
                
                $kyc->status = $request->status;
                $kyc->save();
                return redirect()->route('kyc.index');
        }
        if($role==0){
            $request->validate([
                'user_id' => 'required',
                'mobile_number1' => 'required',
                'mobile_number2' => 'required',
                'id_docs_type' => 'required',
                'id_doc_front' => 'required',
                'id_doc_back' => 'required',
                'country' => 'required',
                'address' => 'required',
                'bank_name' => 'required',
                'branch_name' => 'required',
                'bank_acount_number' => 'required',
                'citizen' => 'required',
                'address' => 'required',
                'status' => 'required',
                ]);
                $kyc = kyc::find($id);
               
                if($request->file('id_doc_front')){
                    $file= $request->file('id_doc_front');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('/kycs/img'), $filename);
                    $kyc->id_front_image = $filename;
                }
                if($request->file('id_doc_back')){
                    $file= $request->file('id_doc_back');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('/kycs/img'), $filename);
                    $kyc->id_back_image = $filename;
                }
                $kyc->user_id = $request->user_id;
                $kyc->mobile_number1 = $request->mobile_number1;
                $kyc->mobile_number2 = $request->mobile_number2;
                $kyc->id_docs_type = $request->id_docs_type;
                $kyc->country = $request->country;
                $kyc->address = $request->address;
                $kyc->bank_name = $request->bank_name;
                $kyc->branch_name = $request->branch_name;
                $kyc->bank_acount_number = $request->bank_acount_number;
                $kyc->citizen = $request->citizen;
                $kyc->address = $request->address;
                $kyc->status = $request->status;
                $kyc->save(); 
                return redirect()->route('kyc.index');
        }
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
