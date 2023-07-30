<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
// post
Route::get('allpost',[PostController::class,'post']);
Route::post('post/search',[PostController::class,'search']);
Route::post('filter/post',[PostController::class,'filter']);

// category
Route::get('allcategory',[CategoryController::class,'allcategory']);
Route::post('category/search',[CategoryController::class,'search']);

// post view count
Route::post('post/viewcount',[PostController::class,'viewcount']);

Route::get('category',[AuthController::class,'category'])->middleware('auth:sanctum');
