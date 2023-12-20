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

Route::get('transactions/pdf', [TransactionsC::class, 'pdf'])->middleware('userAkses:admin,owner');
Route::get('transactions/cetak/{id}', [TransactionsC::class,'cetak'])->name('transactions.cetak')->middleware('userAkses:admin,kasir');
Route::get('products/pdf', [ProductsC::class, 'pdf'])->middleware('userAkses:admin,owner');

Route::resource('products', ProductsC::class)->middleware('userAkses:admin,owner,kasir');

Route::get('transactions', [TransactionsC::class, 'index'])->name('transactions.index')->middleware('userAkses:kasir,admin,owner');
Route::get('transactions/create', [TransactionsC::class, 'create'])->name('transactions.create')->middleware('userAkses:kasir,admin');
Route::post('transactions/create', [TransactionsC::class, 'store'])->name('transactions.store')->middleware('userAkses:kasir,admin');

Route::get('transactions/edit/{id}', [TransactionsC::class, 'edit'])->name('transactions.edit')->middleware('userAkses:admin');
Route::put('transactions/update/{id}', [TransactionsC::class, 'update'])->name('transactions.update')->middleware('userAkses:admin');
Route::delete('transactions/destroy/{id}', [TransactionsC::class, 'destroy'])->name('transactions.destroy')->middleware('userAkses:admin');

Route::resource('users', UsersR::class)->middleware('userAkses:admin');
Route::get('users/changepassword/{id}', [UsersR::class, 'changepassword'])->name('users.changepassword')->middleware('userAkses:admin');
Route::put('users/change/{id}', [UsersR::class, 'change'])->name('users.change')->middleware('userAkses:admin');
Route::delete('users/destroy/{id}', [UsersR::class, 'destroy'])->name('users.destroy')->middleware('userAkses:admin');

Route::resource('log', LogC::class)->middleware('userAkses:admin,owner,kasir');

Route::get('logout', [LoginC::class, 'logout'])->name('logout');
Route::post('login', [LoginC::class, 'login_action'])->name('login.action');
Route::get('login', [LoginC::class, 'login'])->name('login');