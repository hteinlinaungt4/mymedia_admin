<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    // profile
    Route::get('/dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('profile/update',[ProfileController::class,'update'])->name('profile#update');
    Route::get('profile/changepassword',[ProfileController::class,'changepasswordpage'])->name('profile#changepasswordpage');
    Route::post('profile/changepassword',[ProfileController::class,'changepassword'])->name('profile#changepassword');

    // admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/list/delete/{id}',[ListController::class,'delete'])->name('admin#listdelete');

    // category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category',[CategoryController::class,'create'])->name('admin#categorycreate');
    Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('admin#categorydelete');
    Route::get('category/edit/{id}',[CategoryController::class,'editpage'])->name('admin#categoryeditpage');
    Route::post('category/update',[CategoryController::class,'update'])->name('admin#categoryupdate');

    // post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('post',[PostController::class,'create'])->name('admin#postcreate');
    Route::get('post/delete/{id}',[PostController::class,'delete'])->name('admin#postdelete');
    Route::get('post/edit/{id}',[PostController::class,'edit'])->name('admin#posteditpage');
    Route::post('post/update',[PostController::class,'update'])->name('admin#postupdate');

    // trend
    Route::get('trendpost',[TrendPostController::class,'index'])->name('admin#trendpost');


});
