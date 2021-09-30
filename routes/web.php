<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/resetPassForm',[ResetPasswordController::class,'resetPassForm'])->name('resetPassForm');
Route::post('/resetPassCheckEmail',[ResetPasswordController::class,'resetPassCheckEmail'])->name('resetPassCheckEmail');
Route::get('/resetPassHandleForm/{token}/{email}',[ResetPasswordController::class,'resetPassHandleForm'])->name('resetPassHandleForm');
Route::post('/resetPassHandle',[ResetPasswordController::class,'resetPassHandle'])->name('resetPassHandle');

Route::get('/loginForm',[LoginController::class,'loginForm'])->name('loginForm');
Route::post('/login',[LoginController::class,'login'])->name('login');

Route::get('/profile',[LoginController::class,'profile'])->name('profile');
Route::get('/logOut',[LoginController::class,'logOut'])->name('logOut');
