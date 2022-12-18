<?php
use Monarobase\CountryList\CountryListFacade;
Use App\Models\Kyc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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


