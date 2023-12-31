<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\PostController;
//use DB;
use Illuminate\Support\Facades\DB;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes for register and login page
Route::get('login', [AuthController::class, 'index'])->name('login');
   Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'registerView'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
// this route  for dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard']);
// this route  for users curd ..
Route::resource('users', UserController::class);

//Route::get('users', [UserController::class, 'index'])->name('users');

// this route for roles 
Route::resource('roles', RoleController::class);
// this route for posts
Route::resource('posts', PostController::class);