<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoadController;
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
Route::post('/signin',[authController::class, 'signin'])->name('signin');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[HomeController::class, 'home'])->name('home');

    Route::resource('customers', CustomerController::class);
    Route::post('customers/search', [CustomerController::class,'search'])->name('customers.search');
    Route::get('customers/print/{category_type}/{keyword?}/', [CustomerController::class, 'print'])->name('customers.print');

    Route::resource('products', ProductController::class);
    Route::post('products/search', [ProductController::class,'search'])->name('products.search');

    Route::resource('loads', LoadController::class);
    Route::post('loads/search', [LoadController::class,'search'])->name('loads.search');
    Route::get('load/new-loads', [LoadController::class,'getNewLoads'])->name('loads.new-loads');
    Route::get('load/unset-is-new/{load_id?}', [LoadController::class,'unsetIsNew'])->name('load.unset-is-new');
    Route::post('load/new-loads/search', [LoadController::class,'searchNewLoads'])->name('loads.search.new-loads');

    Route::resource('factors', FactorController::class);
    Route::post('factors/search', [FactorController::class,'search'])->name('factors.search');
    Route::get('factor/print/{factor_id}', [FactorController::class,'print'])->name('factor.print');

    Route::resource('safis', SafiController::class);
    Route::post('safis/search', [SafiController::class,'search'])->name('safis.search');
    Route::get('safi/print/{safi_id}', [SafiController::class,'print'])->name('safi.print');
    Route::get('safi/get-products/{load_id}/{product_id}', [SafiController::class,'getProductJsonData'])->name('safi.get-products');


    Route::get('transaction/new-transactions/{type}', [TransactionController::class,'create'])->name('transactions.create');
    Route::post('transaction/new-transactions/{type}', [TransactionController::class,'store'])->name('transactions.store');
    Route::get('transactions', [TransactionController::class,'index'])->name('transactions.index');
    Route::get('customer-transactions/{customer_id}', [TransactionController::class,'customerTransactions'])->name('transactions.customer-transactions');
    Route::delete('transactions/destroy/{transaction_id}', [TransactionController::class,'destroy'])->name('transactions.destroy');
    Route::post('transactions/search', [TransactionController::class,'search'])->name('transactions.search');
    Route::get('transactions/print/{category_type}/{keyword?}/', [TransactionController::class, 'print'])->name('transactions.print');

    Route::get('reports/buyer-customers' , [ReportController::class , 'getBuyerCustomers'])->name('reports.get-buyer-customer');
    Route::post('reports/get-buyer-customer-reports/{print?}' , [ReportController::class , 'getBuyerCustomerReports'])->name('reports.get-buyer-customer-reports');
    Route::get('reports/owner-customers' , [ReportController::class , 'getOwnerCustomers'])->name('reports.get-owner-customer');
    Route::post('reports/get-owner-customer-reports/{print?}' , [ReportController::class , 'getOwnerCustomerReports'])->name('reports.get-owner-customer-reports');

});
