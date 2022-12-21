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
use App\Http\Controllers\OderController;
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
Route::resource('/buy_product', UserBuyController::class);
Route::resource('/oders', OderController::class);
Route::post('/buy_product/real_cash', [UserBuyController::class, 'real_cash'])->name('real_cash');
Route::post('/buy_product/sponsor_funds', [UserBuyController::class, 'sponsor_funds'])->name('sponsor_funds');
Route::post('/buy_product/wallet_and_cash', [UserBuyController::class, 'wallet_and_cash'])->name('wallet_and_cash');
Route::post('/buy_product/product_wallet', [UserBuyController::class, 'product_wallet'])->name('product_wallet');
Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');

Route::resource('/friend_request', PayoutController::class);

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
