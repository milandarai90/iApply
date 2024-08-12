<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\consultancyBranchController;
use App\Http\Controllers\ConsultancyCountryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SuperadminAddController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\SuperadminUsersControllers;
use App\Http\Controllers\GuidelinesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GeneralCountryController;
use App\Http\Controllers\BranchDashboardController;
use App\Http\Controllers\ConsultancyDashboardController;
use App\Http\Controllers\UsersHomepageController;
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

route::get('/', [UsersHomepageController::class, 'index'])->name('showIndex');
route::get('/register', [AuthController::class, 'registerDisplay'])->name('registerDisplay');
route::get('/login', [AuthController::class, 'loginDisplay'])->name('loginDisplay');
route::post('/registered', [AuthController::class, 'registered'])->name('registered');
route::get('/otp_form', [AuthController::class, 'otp_form'])->name('otp_form');
route::post('/otp_verify', [AuthController::class, 'otp_verify'])->name('otp_verify');
route::post('/otp_resend', [AuthController::class, 'otp_resend'])->name('otp_resend');

route::post('/loginCheck', [AuthController::class, 'loginCheck'])->name('loginCheck');
route::get('/logout', [AuthController::class, 'logout'])->name('logout');
route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
route::get('/addProfile', [ProfileController::class, 'addProfile'])->name('addProfile');
route::post('/postProfile', [ProfileController::class, 'postProfile'])->name('postProfile');


Route::prefix('/superadmin')->name('superadmin.')->group(function () {
    Route::middleware(['isSuperAdmin'])->group(function () {
        route::get('/dashboard', [SuperAdminDashboardController::class, 'dashboard'])->name('dashboard');

        //users......................

        route::get('/users', [SuperadminUsersControllers::class, 'users'])->name('users');
        route::get('/view/details', [SuperadminUsersControllers::class, 'viewDetailsofUser'])->name('viewDetailsofUser');
        route::get('/delete', [SuperadminUsersControllers::class, 'delete'])->name('delete');
        route::get('/update', [SuperadminUsersControllers::class, 'update'])->name('update');

        //consultancies..................

        route::get('/addConsultancy', [SuperadminAddController::class, 'addConsultancy'])->name('addConsultancy');
        route::post('/registerConsultancy', [SuperadminAddController::class, 'registerConsultancy'])->name('registerConsultancy');
        route::get('/viewConsultancies', [SuperadminUsersControllers::class, 'viewConsultancies'])->name('viewConsultancies');
        route::post('/updateConsultancy', [SuperadminUsersControllers::class, 'updateConsultancy'])->name('updateConsultancy');

        //branches............

        route::get('/addBranch', [SuperadminAddController::class, 'addBranch'])->name('addBranch');
        route::post('/postBranch', [SuperadminAddController::class, 'postBranch'])->name('postBranch');
        route::get('/viewBranch', [SuperadminUsersControllers::class, 'viewBranch'])->name('viewBranch');
        route::post('/updateBranch', [SuperadminUsersControllers::class, 'updateBranch'])->name('updateBranch');

        //notification..........
        route::get('notification',[NotificationController::class,'notification'])->name('notification');

        //general Country

        route::get('/addGeneralCountry', [GeneralCountryController::class, 'addGeneralCountry'])->name('addGeneralCountry');



    });
});

Route::prefix('/consultancy')->name('consultancy.')->group(function () {
    Route::middleware(['isConsultancy'])->group(function () {
        route::get('/dashboard', [ConsultancyDashboardController::class, 'dashboard'])->name('dashboard');
        route::get('/delete', [consultancyBranchController::class, 'delete'])->name('delete');
        route::get('/viewDetails', [consultancyBranchController::class, 'viewDetails'])->name('viewDetails');

        //branch

        route::get('/addBranch', [consultancyBranchController::class, 'addBranch'])->name('addBranch');
        route::post('/postBranch', [consultancyBranchController::class, 'postBranch'])->name('postBranch');
        route::get('/viewBranch', [consultancyBranchController::class, 'viewBranch'])->name('viewBranch');
        route::get('/updateBranch', [consultancyBranchController::class, 'updateDetails'])->name('updateBranch');
        route::post('/submitBranch', [consultancyBranchController::class, 'submitBranch'])->name('submitBranch');

        //country

        route::get('/addCountry',[ConsultancyCountryController::class,'addCountry'])->name('addCountry');
        route::post('/postCountry',[ConsultancyCountryController::class,'postCountry'])->name('postCountry');
        route::get('/viewCountry',[ConsultancyCountryController::class,'viewCountry'])->name('viewCountry');

        //guidelines

        route::get('/guidelines',[GuidelinesController::class,'guidelines'])->name('guidelines');
        route::get('/guidelinesView',[GuidelinesController::class,'guidelinesView'])->name('guidelinesView');
        route::get('/guidelinesAdd',[GuidelinesController::class,'guidelinesAdd'])->name('guidelinesAdd');
        route::post('/guidelinesPost',[GuidelinesController::class,'guidelinesPost'])->name('guidelinesPost');
    });
});

Route::prefix('/branch')->name('branch.')->group(function () {
    Route::middleware(['isBranch'])->group(function () {
        route::get('/dashboard', [BranchDashboardController::class, 'dashboard'])->name('dashboard');

        //class

        route::get('/addClass', [ClassroomController::class, 'addClass'])->name('addClass');
        route::post('/postClass', [ClassroomController::class, 'postClass'])->name('postClass');
        route::get('/viewClass', [ClassroomController::class, 'viewClass'])->name('viewClass');
        route::get('/viewClass1', [ClassroomController::class, 'viewClass1'])->name('viewClass1');
        route::get('/viewClass2', [ClassroomController::class, 'viewClass2'])->name('viewClass2');
        route::get('/deleteClass', [ClassroomController::class, 'deleteClass'])->name('deleteClass');
        route::get('/editClass', [ClassroomController::class, 'editClass'])->name('editClass');
        route::get('/editClass2', [ClassroomController::class, 'editClass2'])->name('editClass2');
        route::post('/updateClass', [ClassroomController::class, 'updateClass'])->name('updateClass');
        route::post('/updateClass2', [ClassroomController::class, 'updateClass2'])->name('updateClass2');
        route::get('/addStudents1', [ClassroomController::class, 'addStudents1'])->name('addStudents1');
        route::post('/postStudents1', [ClassroomController::class, 'postStudents1'])->name('postStudents1');
        route::get('/addStudents2', [ClassroomController::class, 'addStudents2'])->name('addStudents2');
        route::post('/postStudents2', [ClassroomController::class, 'postStudents2'])->name('postStudents2');


        //course

        route::get('/addCourse', [CourseController::class, 'addCourse'])->name('addCourse');
        route::post('/postCourse', [CourseController::class, 'postCourse'])->name('postCourse');
        route::get('/viewCourse', [CourseController::class, 'viewCourse'])->name('viewCourse');
        route::get('/deleteCourse', [CourseController::class, 'deleteCourse'])->name('deleteCourse');
        route::get('/updateCourse', [CourseController::class, 'updateCourse'])->name('updateCourse');
        route::post('/submitCourse', [CourseController::class, 'submitCourse'])->name('submitCourse');

        //students

        route::get('/addStudents', [StudentsController::class, 'addStudents'])->name('addStudents');
        route::post('/postStudents', [StudentsController::class, 'postStudents'])->name('postStudents');
        route::get('/viewStudents', [StudentsController::class, 'viewStudents'])->name('viewStudents');
        route::get('/bookedStudents', [StudentsController::class, 'bookedStudents'])->name('bookedStudents');
        route::get('/joinedStudents', [StudentsController::class, 'joinedStudents'])->name('joinedStudents');
        route::get('/completedStudents', [StudentsController::class, 'completedStudents'])->name('completedStudents');


    });
});

Route::prefix('/users')->name('users.')->group(function () {
    Route::middleware(['isUser'])->group(function () {

    });
});