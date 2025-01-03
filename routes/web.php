<?php

use App\Http\Controllers\Itemcontroller;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
}); 


Route::post('/register', [Usercontroller::class, 'register']);
Route::post('/logout', [Usercontroller::class,'logout']);
Route::post('/login', [Usercontroller::class,'login']);
Route::get('/', [Itemcontroller::class, 'index']);
Route::post('/store', [ItemController::class, 'store'])->name('store');
Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
