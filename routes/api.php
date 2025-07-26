<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\PasswordController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\TestTypeController as V1TestTypeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProgramTypeController;
use App\Http\Controllers\TestTypeController;

// Route::prefix('v1')->group(function () {
    // Allowed only for trusted devices (API Key required in Authorization header.)
    Route::middleware('trusted')->group(function () {
        Route::post('/auth/login', [AuthController::class, 'login']);
        Route::post('/auth/register', [AuthController::class, 'register']);
        Route::post('/password/email', [PasswordController::class, 'sendResetLinkEmail']);
    });

    Route::prefix('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::middleware('auth:api')->group(function () {
        // reset password
        Route::put('/password', [PasswordController::class, 'reset']);

        Route::get('/users/{user}/avatar', [UserController::class, 'getAvatar'])->name('users.avatar');
        Route::post('/users/{user}/avatar', [UserController::class, 'updateAvatar'])->name('users.update.avatar');
        Route::resource('users', UserController::class)->except(['create', 'edit']);

        // Route::resource('/clients', ClientController::class)->except(['create', 'edit']); // Uncomment if needed

        Route::resource('/test-types', V1TestTypeController::class)->except(['create', 'edit']);
    });

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
// });

// Outside versioned API prefix
Route::resource('/tests', TestController::class)->except(['edit', 'show']);
Route::resource('/test-types', TestTypeController::class)->except(['create', 'edit']);
Route::resource('/program-types', ProgramTypeController::class)->except(['create', 'edit']);
