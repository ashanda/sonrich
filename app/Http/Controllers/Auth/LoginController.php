<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

        public function login(Request $request)

    {   

        $input = $request->all();

   

        $this->validate($request, [

            'email' => 'required|email',

            'password' => 'required',

        ]);

        
        function authenticated(Request $request, $user)
        {
           $user->update([
             'last_login_at' => Carbon::now()->toDateTimeString(),
             'last_login_ip_address' => $request->getClientIp()
           ]);
        }

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
            $user = auth()->user();

            // Check the user's status
            if ($user->status != 1) {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Your account is inactive.');
            }

            if (auth()->user()->role == 1) {

                return redirect()->route('admin');

            }elseif(auth()->user()->role == 2){

                return redirect()->route('super_admin');
                
            }else{

                return redirect()->route('user');

            }

        }else{

            return redirect()->route('login')

                ->with('error','Email-Address And Password Are Wrong.');

        }

          

    }
}
