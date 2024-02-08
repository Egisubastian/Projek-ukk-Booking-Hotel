<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsC;
use App\Http\Controllers\TransactionsC;
use App\Http\Controllers\UsersR;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\LogC;

Route::get('/', function () {
    $subtitle = "Home Page";
    return view('dashboard', compact('subtitle'));
})->middleware('auth');

Route::get('/dashboard', function () { 
    $subtitle = "Home Page";
    return view('dashboard', compact('subtitle'));
})->middleware('auth');

// Tambahkan di web.php
Route::get('/transactions/clearCart', [TransactionsC::class, 'clearCart'])->name('transactions.clearCart');
Route::get('/transactions/checkout', [TransactionsC::class, 'checkout'])->name('transactions.checkout');

Route::post('/transactions/addToCart', [TransactionsC::class, 'addToCart'])->name('transactions.addToCart');
Route::post('/transactions/clearCart', [TransactionsC::class, 'clearCart'])->name('transactions.clearCart');
Route::post('/transactions/checkoutCart', [TransactionsC::class, 'checkoutCart'])->name('transactions.checkoutCart');


Route::get('transactions/pdfFilter', [TransactionsC::class, 'pdfFilter'])->name('transactions.pdfFilter')->middleware('userAkses:owner,admin');
Route::get('transactions/cetak/{id}', [TransactionsC::class,'cetak'])->name('transactions.cetak')->middleware('userAkses:admin,kasir');
Route::get('products/pdf', [ProductsC::class, 'pdf'])->middleware('userAkses:admin,owner');

Route::resource('products', ProductsC::class)->middleware('userAkses:admin,owner,kasir');

Route::get('transactions', [TransactionsC::class, 'index'])->name('transactions.index')->middleware('userAkses:kasir,admin,owner');
Route::get('transactions/create', [TransactionsC::class, 'create'])->name('transactions.create')->middleware('userAkses:kasir,admin');
Route::post('transactions/create', [TransactionsC::class, 'store'])->name('transactions.store')->middleware('userAkses:kasir,admin');

Route::get('transactions/edit/{id}', [TransactionsC::class, 'edit'])->name('transactions.edit')->middleware('userAkses:admin');
Route::put('transactions/update/{id}', [TransactionsC::class, 'update'])->name('transactions.update')->middleware('userAkses:admin');
Route::delete('transactions/destroy/{id}', [TransactionsC::class, 'destroy'])->name('transactions.destroy')->middleware('userAkses:admin');

Route::get('users/pdf', [UsersR::class,'pdf'])->middleware('userAkses:admin,owner');

Route::resource('users', UsersR::class)->middleware('userAkses:admin');
Route::get('users/changepassword/{id}', [UsersR::class, 'changepassword'])->name('users.changepassword')->middleware('userAkses:admin');
Route::put('users/change/{id}', [UsersR::class, 'change'])->name('users.change')->middleware('userAkses:admin');
Route::delete('users/destroy/{id}', [UsersR::class, 'destroy'])->name('users.destroy')->middleware('userAkses:admin');

Route::resource('log', LogC::class)->middleware('userAkses:admin,owner,kasir');

Route::get('logout', [LoginC::class, 'logout'])->name('logout');
Route::post('login', [LoginC::class, 'login_action'])->name('login.action');
Route::get('login', [LoginC::class, 'login'])->name('login');

Route::group(['middleware' => 'admin'], function () {
    // Routes that can only be accessed by admin
    Route::resource('products', ProductsC::class)->names('products')->only(['index']);
    Route::resource('users', UsersR::class)->middleware('userAkses:admin');
});

Route::post('transactions/{id}/checkout', [TransactionsC::class, 'checkout'])->name('transactions.checkout')->middleware('userAkses:kasir');






