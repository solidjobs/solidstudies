<?php

use App\Http\Controllers\LoginController;
use App\Http\Middleware\LoadUserFromToken;
use App\Models\User;
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

Route::get('/user', function (Request $request) {
    return $request->session()->get('user');
})->middleware([LoadUserFromToken::class]);

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [
        LoginController::class,
        'authenticate'
    ]);

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::post('logout', [
            LoginController::class,
            'logout'
        ]);
    });
});

Route::get('/ping', function () {
    return \response()->json(['PONG']);
});

Route::get('/info', function () {
    phpinfo();
});
