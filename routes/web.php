<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BillsController;

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/bills', [App\Http\Controllers\HomeController::class, 'bills'])->name('bills');
Route::get('/categories', [App\Http\Controllers\HomeController::class, 'categories'])->name('categories');
Route::get('/addresses', [App\Http\Controllers\HomeController::class, 'addresses'])->name('addresses');
Route::get('/history', [App\Http\Controllers\HomeController::class, 'history'])->name('history');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contact/send', [App\Http\Controllers\HomeController::class, 'send'])->name('send_mail');

Route::post('/categories', [App\Http\Controllers\CategoriesController::class, 'main'])->name('add_category');
Route::post('/bills', [App\Http\Controllers\BillsController::class, 'main'])->name('add_bill');
Route::get('/bills/delete/{bill}', [App\Http\Controllers\BillsController::class, 'delete'])->name('bill_delete');


Route::post('/bills/add',[BillsController::class, 'add'])->name('add');
Route::post('/bills/pay/{bill}',[BillsController::class, 'pay'])->name('pay');
Route::post('/bills/submit_pay/{bill}',[BillsController::class, 'submit_pay'])->name('submit_pay');

Route::get('/bills/details/{bill}',[BillsController::class, 'details'])->name('bill_details');

Route::get('/addresses/details/{address}', [App\Http\Controllers\AddressController::class, 'show'])->name('address_details');
Route::post('/addresses/update/{address}', [App\Http\Controllers\AddressController::class, 'update'])->name('address_edit');
Route::get('/addresses/delete/{address}', [App\Http\Controllers\AddressController::class, 'destroy'])->name('address_delete');

Route::get('/addresses/create', [App\Http\Controllers\AddressController::class, 'create'])->name('create_address');
Route::post('/addresses/store', [App\Http\Controllers\AddressController::class, 'store'])->name('store_address');

Route::post('/wallet', [App\Http\Controllers\UserBalanceController::class, 'index'])->name('wallet');
Route::post('/wallet/add_money/{userBalance}', [App\Http\Controllers\UserBalanceController::class, 'update'])->name('add_money');



