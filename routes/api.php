<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->prefix('user')->group(function(){
    Route::post('/post','post')->name('postUser');
    Route::get('/get/{id}','get')->name('getUser');
    Route::put('/put/{id}','put')->name('putUser');
    Route::delete('/delete/{id}','delete')->name('deleteUser');
});

