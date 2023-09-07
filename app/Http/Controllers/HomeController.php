<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\oder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $role=Auth::user()->role;
        if($role==2){

            return view('userModule.super_admin.superadminHome');

        }elseif($role == 1){

            return view('userModule.admin.adminHome');

        }elseif($role == 0){

            return view('userModule.user.userHome');

        }else{
            
            return view('home');
        }  
         
 
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


     public function all_user(){
        $all_user = User::where('status',1)->paginate(20);;
        return view('userModule.admin.all_user')->with(compact('all_user'));
     }


     public function edit_user(Request $request,$id){
        $edit_user = User::where('id',$id)->first();
        return view('userModule.admin.edit_user')->with(compact('edit_user'));
        
     }


     public function update_user(Request $request, $id)
    {
        $request->validate([
            'sri_number' => array(['required','regex:/(^0{0,3}[1-9]\d*$)/u']),
            'fname' =>'required|string|max:255',
            'lname' =>'required|string|max:255',
            'email'=>'required|email|string|max:255',
            'status'=>'required'
        ]);

        $user =  User::find($id);
        $user->sri_number = $request['sri_number'];
        $user->srr_number= Str::upper($request['srr_number']);
        $user->fname = $request['fname'];
        $user->lname = $request['lname'];
        $user->email = $request['email'];
        $user->status = $request['status'];
       
        if($request['password'] != null){
            $user->password = Hash::make($request['password']);
        }
        if (!empty($request['oder_srr'])) {
            $user_oders = User::with('user_oder')->where('id', $id)->first();

            foreach ($user_oders->user_oder as $user_oder) {
                $oder = oder::find($user_oder->id);
                $oder->srr_number = $request['oder_srr'];
                $oder->save();
            }
        }
        $user->save();
        
        return back()->with('message','Profile Updated');
    }

    public function change_doller(Request $request){

        $user = DB::table('master')->where('id', '=', 1)
        ->update(['doller_rate' => $request->dollarRate]);

        alert()->success('Success','Change Dollar rate Successfully!');
        return redirect()->route('admin');
    }
}
