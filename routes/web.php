<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\consultancyBranchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SuperadminAddController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\SuperadminUsersControllers;

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
route::post('/loginCheck', [AuthController::class, 'loginCheck'])->name('loginCheck');
route::get('/logout', [AuthController::class, 'logout'])->name('logout');


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
    });
});

Route::prefix('/branch')->name('branch.')->group(function () {
    Route::middleware(['isBranch'])->group(function () {
        route::get('/dashboard', [BranchDashboardController::class, 'dashboard'])->name('dashboard');

        //class

        route::get('/addClass', [ClassroomController::class, 'addClass'])->name('addClass');
        // route::post('/postClass', [ClassroomController::class, 'postClass'])->name('postClass');

        //course

        route::get('/addCourse', [CourseController::class, 'addCourse'])->name('addCourse');
        route::post('/postCourse', [CourseController::class, 'postCourse'])->name('postCourse');
        route::get('/viewCourse', [CourseController::class, 'viewCourse'])->name('viewCourse');
        route::get('/deleteCourse', [CourseController::class, 'deleteCourse'])->name('deleteCourse');

    });
});

Route::prefix('/users')->name('users.')->group(function () {
    Route::middleware(['isUser'])->group(function () {

    });
});