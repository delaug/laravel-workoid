<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BoardController;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\ListCardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

Route::prefix('v1')->group(function () {
    /*
     * Public routes
     */
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');


    /*
     * Protected routes
     */
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::apiResources([
            'users' => UserController::class,
            'roles' => RoleController::class,
            'boards' => BoardController::class,
            'list-cards' => ListCardController::class,
            'cards' => CardController::class,
        ],
        ['parameters' => [ 'users' => 'subject']]);
    });


    // Unhandled routes
    Route::any('{any}', function () {
        return response()->json(['status' => Response::HTTP_NOT_FOUND], Response::HTTP_NOT_FOUND);
    })->where(['any' => '(.*)']);
});
