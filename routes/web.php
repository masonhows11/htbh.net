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

use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminLessonController;

use App\Http\Controllers\Admin\AdminCommentController;


use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Front\CourseController;

use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\LikeController;



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
    Route::get('/edit',[AdminPostController::class,'edit'])->name('editArticle');
    Route::post('/update',[AdminPostController::class,'update'])->name('updateArticle');
    Route::post('/confirm',[AdminPostController::class,'confirm'])->name('approveArticle');
    Route::get('/delete',[AdminPostController::class,'delete'])->name('deleteArticle');
    Route::post('/listPostCategory',[AdminPostController::class,'listPostBaseCategory'])->name('listPostCategory');

});

Route::group(['prefix'=>'admin/course','middleware'=>'role:admin'],function (){

    Route::get('/index', [AdminCourseController::class, 'index'])->name('courses');
    Route::post('/listCourseCategory',[AdminCourseController::class,'listCourseBaseCategory'])->name('listCourseCategory');
    Route::get('/create', [AdminCourseController::class, 'create'])->name('newCourse');
    Route::post('/store', [AdminCourseController::class, 'store'])->name('storeNewCourse');
    Route::get('/edit', [AdminCourseController::class, 'edit']);
    Route::post('/update', [AdminCourseController::class, 'update'])->name('updateCourse');
    Route::get('/delete', [AdminCourseController::class, 'delete'])->name('deleteCourse');
    Route::post('/changePublishStatus', [AdminCourseController::class, 'changePublishStatus'])->name('changePublishStatus');
    Route::get('/detail', [AdminCourseController::class, 'detail'])->name('courseDetail');
    Route::get('/active', [AdminCourseController::class, 'changeStatus']);

});

Route::group(['prefix'=>'admin/lesson','middleware'=>'role:admin'],function (){


    Route::get('/newLesson', [AdminLessonController::class, 'createNewLesson'])->name('newLesson');
    Route::post('/storeNewLesson', [AdminLessonController::class, 'storeNewLesson'])->name('storeNewLesson');
    Route::get('/editLesson', [AdminLessonController::class, 'editLesson']);
    Route::post('/updateLesson', [AdminLessonController::class, 'updateLesson'])->name('updateLesson');
    Route::get('/deleteLesson', [AdminLessonController::class, 'deleteLesson'])->name('deleteLesson');
});

Route::group(['prefix' => 'admin/comments', 'middleware' => 'role:admin'], function () {


    Route::get('/getCourses', [AdminCommentController::class, 'getCourses'])->name('getCourses');
    Route::get('/getCoursesCategory',[AdminCommentController::class,'getCoursesCategory'])->name('getCoursesCategory');
    Route::get('/getCourseComments',[AdminCommentController::class,'getCourseComments'])->name('getCourseComments');




    Route::get('/getPostComments', [AdminCommentController::class, 'getPostsComments'])->name('getPostComments');


    Route::post('/approvedComment', [AdminCommentController::class, 'approvedComment'])->name('approvedComment');
    Route::get('/deleteComment', [AdminCommentController::class, 'deleteComment'])->name('deleteComment');

});

///////////////////////////////////////// front section /////////////////////////////////////////////////////
Route::group(['prefix' => 'like'], function () {

    Route::post('/addPostLike', [LikeController::class, 'postLike'])->name('add_post_Like');
    Route::get('/countPostLike', [LikeController::class, 'postLikeCount'])->name('get_post_likes');

    Route::post('/addCourseLike', [LikeController::class, 'courseLike'])->name('add_course_Like');
    Route::get('/countCourseLike', [LikeController::class, 'courseLikeCount'])->name('get_course_likes');


});

Route::group(['prefix' => 'comment'], function () {
    Route::post('/store', [CommentController::class,'store'])->name('commentStore');
});

Route::group(['prefix'=>'course'],function (){

    Route::get('/get/{course}',[CourseController::class,'course'])->name('course');

});

Route::group(['prefix'=>'article'],function (){

    Route::get('/get/{article}',[ArticleController::class,'article'])->name('article');

});
