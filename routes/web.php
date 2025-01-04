<?php

use App\Http\Controllers\WebLayoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Item routes
Route::group(['prefix' => 'items'], function () {
    Route::post('/', [ItemController::class, 'store'])->name('store');
    Route::get('/{item_id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/{item_id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/{item_id}', [ItemController::class, 'destroy'])->name('items.destroy');
});

Route::get('/web_layout', [WebLayoutController::class, 'web_layout'])->name('web_layout');