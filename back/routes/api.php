<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ActionController::class)->group(function () {
    //
});

Route::controller(UserController::class)->group(function () {
    Route::post('user', 'store');
    Route::get('user/{user}', 'show');
    Route::get('user/users','showAll');
    Route::put('user/{user}', 'update');
    Route::delete('user/{user}', 'destroy');
});
