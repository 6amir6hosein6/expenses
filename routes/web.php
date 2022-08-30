<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SafiController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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
Route::get('/login',[authController::class, 'login'])->name('login');
Route::post('/owner-signup',[authController::class, 'ownerSignup'])->name('owner-signup');
Route::post('/owner-signin',[authController::class, 'ownerSignin'])->name('owner-signin');

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/',[HomeController::class, 'home'])->name('home');
    Route::get('/logout',[authController::class, 'logout'])->name('logout');

    Route::resource('members',MemberController::class);
    Route::resource('transactions',TransactionController::class);
    Route::get('my-transactions',[TransactionController::class,'myTransactions'])->name('my-transactions');

    Route::post('transaction-reports-weekly',[ReportController::class,'transactionReportsWeekly'])->name('reports.transaction_reports_weekly');
    Route::post('transaction-reports-monthly',[ReportController::class,'transactionReportsMonthly'])->name('reports.transaction_reports_monthly');

    Route::resource('messages',MessageController::class);
});
