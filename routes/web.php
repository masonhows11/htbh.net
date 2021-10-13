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
use App\Http\Controllers\Admin\AdminPermController;

use App\Http\Controllers\Admin\AdminRoleAssignController;
use App\Http\Controllers\Admin\AdminPermAssignController;

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminPostController;
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

////////////////////////////////////////// auth section routes ////////////////////////////////////////////

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


/////////////////////////////////// admin section routes ////////////////////////////////////////////////////

Route::get('/admin/index',[AdminController::class,'admin'])->name('admin_dash')->middleware(['role:admin']);
Route::group(['prefix' => 'admin','middleware'=>'role:admin'], function () {

    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/edit',[AdminUserController::class,'edit']);
    Route::post('/update',[AdminUserController::class,'update'])->name('userUpdate');
    Route::get('/userDelete', [AdminUserController::class, 'delete'])->name('deleteUser');

});

Route::group(['prefix'=>'admin','middleware'=>'role:admin'],function (){

    Route::get('/roles',[AdminRoleController::class,'index'])->name('roles');
    Route::post('/storeRole',[AdminRoleController::class,'store'])->name('storeNewRole');
    Route::get('/editRole',[AdminRoleController::class,'edit'])->name('editRole');
    Route::post('/updateRole',[AdminRoleController::class,'update'])->name('updateRole');
    Route::get('/deleteRole',[AdminRoleController::class,'delete'])->name('deleteRole');
});

Route::group(['prefix'=>'admin','middleware'=>'role:admin'],function (){

    Route::get('/perms',[AdminPermController::class,'index'])->name('perms');
    Route::post('/storePerm',[AdminPermController::class,'store'])->name('storeNewPerm');
    Route::get('/editPerm',[AdminPermController::class,'edit'])->name('editPerm');
    Route::post('/updatePerm',[AdminPermController::class,'update'])->name('updatePerm');
    Route::get('/deletePerm',[AdminPermController::class,'delete'])->name('deletePerm');
});

Route::group(['prefix'=>'admin/roleAssign','middleware'=>'role:admin'],function (){

    Route::get('/list',[AdminRoleAssignController::class,'index'])->name('listUsers');
    Route::get('/assignRoleForm',[AdminRoleAssignController::class,'assignForm'])->name('assignRoleForm');
    Route::post('/assignRole',[AdminRoleAssignController::class,'assign'])->name('assignRole');

});

Route::group(['prefix'=>'admin/permAssign','middleware'=>'role:admin'],function (){

    Route::get('/list',[AdminPermAssignController::class,'index'])->name('listRoles');
    Route::get('/assignPermForm',[AdminPermAssignController::class,'assignForm'])->name('assignPermForm');
    Route::post('/assignPerm',[AdminPermAssignController::class,'assign'])->name('assignPerm');

});

Route::group(['prefix'=>'admin/category','middleware'=>'role:admin'],function (){

    Route::get('/index',[AdminCategoryController::class,'index'])->name('listCategory');
    Route::post('/store',[AdminCategoryController::class,'store'])->name('storeNewCategory');
    Route::get('/edit',[AdminCategoryController::class,'edit'])->name('editCategory');
    Route::post('/update',[AdminCategoryController::class,'update'])->name('updateCategory');
    Route::get('/detachParent',[AdminCategoryController::class,'detachParent'])->name('detachParent');
    Route::get('/delete',[AdminCategoryController::class,'delete'])->name('deleteCategory');


});

Route::group(['prefix'=>'admin/article','middleware'=>'role:admin'],function (){

    Route::get('/index',[AdminPostController::class,'index'])->name('articles');
    Route::get('/create',[AdminPostController::class,'create'])->name('newArticle');
    Route::post('/store',[AdminPostController::class,'store'])->name('storeNewArticle');
    Route::post('/postImage',[AdminPostController::class,'storePostImage'])->name('postImage');
    Route::get('/edit',[AdminPostController::class,'edit'])->name('editArticle');
    Route::post('/updated',[AdminPostController::class,'update'])->name('updateArticle');
    Route::get('/confirm',[AdminPostController::class,'confirm'])->name('confirmArticle');
    Route::get('/delete',[AdminPostController::class,'delete'])->name('deleteArticle');
    Route::post('/listPostCategory',[AdminPostController::class,'listPostBaseCategory'])->name('listPostCategory');


});
