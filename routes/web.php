<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ImageController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
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

Route::get('/',[HomeController::class,'home'])->name('home');

Route::get('/registerForm',[RegisterController::class,'registerForm'])->name('registerForm');
Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::get('/verifyEmail/{id}/{code}',[VerifyEmailController::class,'verifyEmail'])->name('verifyEmail');
Route::get('/resendVerifyEmailForm',[VerifyEmailController::class,'resendVerifyEmailForm'])->name('resendVerifyEmailForm');
Route::post('/checkEmail',[VerifyEmailController::class,'checkEmailVerify'])->name('checkEmail');

Route::get('/resetPassForm',[ResetPasswordController::class,'resetPassForm'])->name('resetPassForm')->middleware('auth');
Route::post('/resetPassCheckEmail',[ResetPasswordController::class,'resetPassCheckEmail'])->name('resetPassCheckEmail');
Route::get('/resetPassHandleForm/{token}/{email}',[ResetPasswordController::class,'resetPassHandleForm'])->name('resetPassHandleForm');
Route::post('/resetPassHandle',[ResetPasswordController::class,'resetPassHandle'])->name('resetPassHandle');


Route::get('/loginForm',[LoginController::class,'loginForm'])->name('loginForm');
Route::post('/login',[LoginController::class,'login'])->name('login')->middleware(['throttle:3,1']);
Route::get('/logOut',[LoginController::class,'logOut'])->name('logOut');

Route::get('/profile',[ProfileController::class,'profile'])->name('profile')->middleware('auth','verifiedUser');
Route::post('/updateProfile',[ProfileController::class,'updateProfile'])->name('updateProfile')->middleware('auth','verifiedUser');
Route::get('/editEmailForm',[ProfileController::class,'editEmailForm'])->name('editEmailForm')->middleware('auth','verifiedUser');
Route::post('/editEmail',[ProfileController::class,'editEmail'])->name('editEmail')->middleware('auth');
Route::get('/confirmEditEmail/{id}/{code}',[ProfileController::class,'confirmEditEmail'])->name('confirmEditEmail');


Route::post('/imageStore',[ImageController::class,'store'])->name('imageStore')->middleware('auth');


Route::get('/admin/index',[AdminController::class,'admin'])->name('admin_dash')->middleware(['role:admin']);

//, 'middleware' => 'role:admin'
Route::group(['prefix' => 'admin','middleware'=>'role:admin'], function () {

    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/edit',[AdminUserController::class,'edit']);
    Route::post('/update',[AdminUserController::class,'update'])->name('userUpdate');
    Route::get('/userDelete', [AdminUserController::class, 'delete'])->name('deleteUser');

});

Route::group(['prefix'=>'admin','middleware'=>'role:admin'],function (){

    Route::get('/roles',[AdminRoleController::class,'index'])->name('roles');
});
