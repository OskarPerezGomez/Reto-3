<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ActionController::class)->group(function () {
    Route::post('action', 'store');
    Route::get('action/{action}', 'show');
    Route::get('action/actions','showAll');
    Route::put('action/{action}/update', 'update');
    Route::delete('action/{action}/destroy', 'destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::post('user', 'store');
    Route::get('user/{user}', 'show');
    Route::get('user/users','showAll');
    Route::put('user/{user}/update', 'update');
    Route::delete('user/{user}/destroy', 'destroy');
});

Route::controller(CenterController::class)->group(function () {
    Route::post('center', 'store');
    Route::get('center/{center}', 'show');
    Route::get('center/centers','showAll');
    Route::put('center/{center}/update', 'update');
    Route::delete('center/{center}/destroy', 'destroy');
});
