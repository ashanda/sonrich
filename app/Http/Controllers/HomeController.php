<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
     /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

     public function index()

     {
 
         return view('home');
 
     }
 
   
 
     /**
 
      * Show the application dashboard.
 
      *
 
      * @return \Illuminate\Contracts\Support\Renderable
 
      */
 
     public function admin()
 
     {
 
         return view('userModule.admin.adminHome');
 
     }
     public function superadmin()
 
     {
 
         return view('userModule.super_admin.superadminHome');
 
     }
     public function user()
 
     {
 
         return view('userModule.user.userHome');
 
     }
}
