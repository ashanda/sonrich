<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GenealogyController extends Controller
{
    public function index()
    {
    $role=Auth::user()->role;
    if($role==1 || $role==2) {

        return view('genModule.index');
    }
    if($role==0){
        
        return view('genModule.index');
    }
}



}
