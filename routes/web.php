<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GoogleController;
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

    //Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::resource('users', UserController::class);
    //Route::resource('roles', RoleController::class);


//Route::resource('users', UserController::class);

//Route::get('users', [UserController::class, 'index'])->name('users');

// this route for roles 
Route::resource('roles', RoleController::class);
// this route for posts
Route::resource('posts', PostController::class);


// this route for logout page 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/form', function () {
    return view('form');
});


Route::get('/form1', function () {
    return view('form1');
});

Route::get('userregister', [RoleUserController::class, 'RegisterView'])->name('userregister');
Route::post('userregister', [RoleUserController::class, 'Register'])->name('userregister');
Route::get('userlogin', [RoleUserController::class, 'index'])->name('userlogin');
Route::post('userlogin', [RoleUserController::class, 'Login'])->name('userlogin');

Route::post('/comments', [CommentController::class,'store'])->name('comments.store');

 //Route::get('/viewall', [RoleUserController::class,'viewall'])->name('viewall');
Route::get('/viewdetail/{id}', [RoleUserController::class,'show'])->name('userview.viewdetail');

Route::get('userdashboard', [RoleUserController::class, 'dashboard']);


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::get('/welcomeuser', function () {
    return view('welcomeuser');
});

Route::group(['middleware'=>['auth','CheckUserRole:user']],function(){
    Route::get('/viewall', [RoleUserController::class,'viewall'])->name('viewall');
});
Route::get('dashboard', [AuthController::class, 'dashboard']);

Route::group(['middleware'=>['IsAdmin',':admin']],function(){
    //Route::get('dashboard', [AuthController::class, 'dashboard']);

});

//Route::post('/reply/store', [CommentController::class,'replyStore'])->name('reply.add');

Route::post('/reply', [CommentController::class,'Reply'])->name('reply.add');
Route::middleware(['auth'])->group(function () {
    // Your routes here
});