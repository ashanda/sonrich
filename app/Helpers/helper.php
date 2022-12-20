<?php
use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
Use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

 function getCountryList(){
    $countries = CountryListFacade::getList('en');
     return $countries;
 } 

 function get_user_kyc(){
    if(Auth::user()->role == 2 || Auth::user()->role == 1){
        $kyc = Kyc::all();
    }else{
        $kyc = Kyc::where('user_id', Auth::user()->id)->get();
    }
    
    return $kyc;
 }

function user_product_count(){
    $user_count = DB::table('user_oder_counts')->where('user_id',Auth::user()->id)->first();
    return $user_count;
}



