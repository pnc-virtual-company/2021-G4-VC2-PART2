<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\CompanyDetailController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// ___________________USER_____________________ //
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/users', [UserController::class, 'index']);
Route::put('/users/usersVerify/{id}', [UserController::class, 'verifyUserComplet']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('/users/images/{id}', [UserController::class, 'updateImage']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/users/search/{name}', [UserController::class, 'search']);

// __________________USER DETAIL_______________ //
Route::get('/usersDetail', [UserDetailController::class, 'index']);
Route::get('/usersDetail/{id}', [UserDetailController::class, 'show']);
Route::post('/usersDetail', [UserDetailController::class, 'store']);
Route::put('/usersDetail/{id}', [UserDetailController::class, 'update']);
Route::delete('/usersDetail/{id}', [UserDetailController::class, 'destroy']);

// __________________COMPANY___________________ //
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);
Route::get('/companies/search/{name}', [CompanyController::class, 'search']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);

// __________________COMPANY DETAIL_________________ //
Route::get('/companies_detail', [CompanyDetailController::class, 'index']);
Route::get('/companies_detail/{id}', [CompanyDetailController::class, 'show']);
Route::get('/companies_user_detail/{id}', [CompanyDetailController::class, 'getOne']);
Route::post('/companies_detail', [CompanyDetailController::class, 'store']);
Route::put('/companies_detail/{id}', [CompanyDetailController::class, 'update']);
Route::delete('/companies_detail/{id}', [CompanyDetailController::class, 'destroy']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::put('users/{id}', [UserController::class, 'update']);

    Route::post('/logout', [UserController::class, 'logout']);
});
