<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\UserBuyController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PayoutController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
   
Route::middleware(['auth'])->group(function () {
   
Route::middleware(['2fa'])->group(function () {
Route::resource('/edit-profile',EditUserController::class); 
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/super_admin', [HomeController::class, 'superadmin'])->name('super_admin');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
Route::get('/user', [HomeController::class, 'user'])->name('user');
Route::resource('/buy_package', UserBuyController::class);
Route::get('/buy_product/real_cash', [UserBuyController::class, 'real_cash'])->name('real_cash');

Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
Route::get('/friend_request', [PayoutController::class, 'index'])->name('friend_request');
Route::get('/p2p', [PayoutController::class, 'index'])->name('p2p');
Route::resource('/package', KycController::class);
Route::resource('/kyc', KycController::class);
Route::resource('/product', ProductController::class);
Route::post('/2fa', function () {

        
        if (auth()->user()->role == 2) {

            return redirect(route('super_admin'));

        }elseif(auth()->user()->role == 1){ 

            return redirect(route('admin'));

        }else{

            return redirect(route('user'));

        }
    })->name('2fa');

});
});

Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');
