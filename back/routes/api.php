<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserDetailController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// User
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('/users/images/{id}', [UserController::class, 'updateImage']);

// User Detail
Route::get('/usersDetail', [UserDetailController::class, 'index']);
Route::get('/usersDetail/{id}', [UserDetailController::class, 'show']);
Route::post('/usersDetail', [UserDetailController::class, 'store']);
Route::put('/usersDetail/{id}', [UserDetailController::class, 'update']);
Route::delete('/usersDetail/{id}', [UserDetailController::class, 'destroy']);

// company
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::get('/users/search/{name}', [UsersController::class, 'search']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::post('/logout', [UserController::class, 'logout']);
});
