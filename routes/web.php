<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
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



Route::get('/',[UserController::class,'Index'])->name('index');


Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//User Routes
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::get('/user/logout',[UserController::class,'UserLogout'])->name('user.logout');
    Route::post('/user/profile/store',[UserController::class,'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/change/password',[UserController::class,'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update',[UserController::class,'UserUpdatePassword'])->name('user.password.update');

  
    
});

require __DIR__.'/auth.php';

//All Admin Routes
//// Admin Group Middleware
Route::middleware(['auth','roles:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update',[AdminController::class,'AdminPasswordUpdate'])->name('admin.password.update');

      //Category Routes
      Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });

    //Sub Category Routes
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
    });

    //Instructor Routes
    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/instructor','AllInstructors')->name('all.instructors');
        Route::post('/update/user/status','UpdateUserStatus')->name('update.user.status');
    });

});
Route::get('/admin/login',[AdminController::class,'AdminLogin'])->name('admin.login');
Route::get('/become/instructor',[AdminController::class,'BecomeInstructor'])->name('become.instructor');
Route::post('/instructor/register',[AdminController::class,'InstructorRegister'])->name('instructor.register');


//All Instructor Routes
/// Instructor Group Middleware
Route::middleware(['auth','roles:instructor'])->group(function(){
    Route::get('/instructor/dashboard',[InstructorController::class,'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout',[InstructorController::class,'InstructorLogout'])->name('instructor.logout');
    Route::get('/instructor/profile',[InstructorController::class,'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store',[InstructorController::class,'InstructorProfileStore'])->name('instructor.profile.store');
    Route::get('/instructor/change/password',[InstructorController::class,'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update',[InstructorController::class,'InstructorPasswordUpdate'])->name('instructor.password.update');

    //Course Routes
    Route::controller(CourseController::class)->group(function(){
        Route::get('/all/course','AllCourse')->name('all.course');
        Route::get('/add/course','AddCourse')->name('add.course');
        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
        Route::post('/store/course','StoreCourse')->name('store.course');
        Route::get('/edit/course/{id}','EditCourse')->name('edit.course');
        Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal','UpdateCourseGoal')->name('update.course.goal');
        Route::get('/delete/course/{id}','DeleteCourse')->name('delete.course');

    });

     //Course Section and Lecture Routes
     Route::controller(CourseController::class)->group(function(){
        Route::get('/add/course/lecture/{id}','AddCourseLecture')->name('add.course.lecture');
        Route::post('/add/course/section/','AddCourseSection')->name('add.course.section');


    });
});
Route::get('/instructor/login',[InstructorController::class,'InstructorLogin'])->name('instructor.login');




