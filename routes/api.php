<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Uncomment this route if you want to return the authenticated user's information
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/userregister', [AuthController::class, 'userregister']);
Route::post('/userlogin', [AuthController::class, 'userlogin']);

// Corrected middleware group and missing semicolons
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::get('/myuser',[AuthController::class ,'myuser' ]);

    Route::post('/userlogout', [AuthController::class, 'userlogout']);


});
