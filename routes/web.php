<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Admin\{ AuthController, CreateController, profileController, UserController };
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;


Route::get('/', function () {
    return view('welcome');
});

Route::view('admin','admin');

Route::get('/admin/login',[AuthController::class,'getLogin'])->name('getLogin');
Route::post('/admin/login',[AuthController::class,'postLogin'])->name('postLogin');
Route::get('/admin/dashboard',[profileController::class,'dashboard'])->name('dashboard');
Route::get('/admin/users',[UserController::class,'index'])->name('users.index');
Route::get('/admin/logout',[ProfileController::class,'logout'])->name('logout');

Route::get('create', [CreateController::class, 'create'])->name('create');
Route::get('index', [CreateController::class, 'index'])->name('index');
Route::post('store', [CreateController::class, 'store'])->name('store');
Route::get('edit/{id}', [CreateController::class, 'edit'])->name('edit');
Route::put('update/{id}', [CreateController::class, 'update'])->name('update');
Route::delete('delete/{id}', [CreateController::class, 'destroy'])->name('delete');
Route::get('getUser', [CreateController::class, 'getUser'])->name('getUser');
 
Route::get('profile', [CreateController::class, 'profile'])->name('profile');
Route::put('profile/update/{id}', [UsersController::class, 'update'])->name('updateProfile');

//BLOG
    Route::get('home', [BlogController::class, 'home'])->name('home');
    Route::get('createuser', [BlogController::class, 'createuser'])->name('createuser');

    Route::get('blogcreate', [BlogController::class, 'blogcreate'])->name('blogcreate');
    Route::get('userlist', [BlogController::class, 'blogindex'])->name('bloguserlist');
    Route::post('blogstore', [BlogController::class, 'blogstore'])->name('blogstore');
    Route::get('blogedit/{id}', [BlogController::class, 'blogedit'])->name('blogedit');
    Route::put('blogupdate/{id}', [BlogController::class, 'blogupdate'])->name('blogupdate');
    Route::get('delete/{id}', [BlogController::class, 'blogdestroy'])->name('blogdelete');
    Route::get('bloggetdata', [BlogController::class, 'bloggetUser'])->name('bloggetUser');



    Route::get('createcategory', [CategoryController::class, 'createcategory'])->name('createcategory');
    Route::post('storecategory', [CategoryController::class, 'store'])->name('storecategory');
    Route::get('getdata', [CategoryController::class, 'index'])->name('getdata');














