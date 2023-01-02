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
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\P2pController;
use App\Http\Controllers\GenealogyController;
use App\Http\Controllers\ReportController;
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
Route::get('/all-oders', [OderController::class, 'all_oders'])->name('all-oders');
Route::resource('/buy_product', UserBuyController::class);
Route::resource('/p2p', P2pController::class);
Route::resource('/oders', OderController::class);
Route::get('/withdrawal', [WithdrawalController::class, 'index'])->name('withdrawal');
Route::resource('/withdraw', WithdrawalController::class);
Route::post('cash/trans', [WithdrawalController::class, 'cash_trans'])->name('withdrawal');
Route::post('p2p/trans', [WithdrawalController::class, 'p2p_trans'])->name('withdrawal');

Route::get('trans/cash', [WithdrawalController::class, 'cash'])->name('withdrawal');
Route::get('trans/p2p', [WithdrawalController::class, 'p2p'])->name('withdrawal');


Route::post('/buy_product/real_cash', [UserBuyController::class, 'real_cash'])->name('real_cash');
Route::post('/buy_product/sponsor_funds', [UserBuyController::class, 'sponsor_funds'])->name('sponsor_funds');
Route::post('/buy_product/wallet_and_cash', [UserBuyController::class, 'wallet_and_cash'])->name('wallet_and_cash');
Route::post('/buy_product/product_wallet', [UserBuyController::class, 'product_wallet'])->name('product_wallet');

Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
Route::get('/pending_request', [WalletController::class, 'index'])->name('wallet');
Route::resource('/friend_request', PayoutController::class);
Route::get('/genealogy' , [GenealogyController::class,'index'])->name('genealogy');
Route::resource('/package', KycController::class);
Route::resource('/kyc', KycController::class);
Route::resource('/product', ProductController::class);

Route::get('/binary_report', [ReportController::class, 'binary_report'])->name('binary_report');
Route::get('/direct_report', [ReportController::class, 'direct_report'])->name('direct_report');
Route::get('/level_report', [ReportController::class, 'level_report'])->name('level_report');
Route::get('/daily_report', [ReportController::class, 'daily_report'])->name('daily_report');

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
