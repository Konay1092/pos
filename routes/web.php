<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\auth\RegisterController;
use App\Http\Controllers\admin\home\HomePageController;
use App\Http\Controllers\admin\user\AdminController;
use App\Http\Controllers\admin\user\UserController;

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

Route::middleware(['auth', 'admin'])->group(
    function () {

        Route::get('/dashboard', [HomePageController::class, 'index'])->name('home');
        Route::post('/logout', [LoginController::class, 'logout'])
            ->name('logout');
        Route::get('/admin/change-password', [LoginController::class, 'changePassword'])->name('admin.change-password');
        Route::post('admin/password/update', [LoginController::class, 'updatePassword'])->name('password.update');

        // For profile
        Route::get('/admin/profile', [AdminController::class, 'show'])->name('admin.profile');
        Route::post('/admin/profile/upload', [AdminController::class, 'uploadProfilePicture'])->name('admin.profile.upload');
        Route::get('/admin/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/admin/profile/update', [AdminController::class, 'updateSettings'])->name('user.settings.update');


        // For all user role
        Route::get('/admin/role/users', [UserController::class, 'index'])->name('admin.user');
        Route::get('/admin/role/user/{id}', [UserController::class, 'userDetails'])->name('admin.user.show');
        Route::get('/admin/role/delete/user/{id}', [UserController::class, 'deleteUser'])->name('admin.user.delete');
    }
);

Route::get('/', [HomePageController::class, 'check'])->name('check');

// Route::get('/mail', [AuthApiController::class, 'mail']);


Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login')->middleware('route');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::get('/admin/forgot_password', [LoginController::class, 'forgotPassword'])->name('admin.forgot_password');
Route::post('/admin/send-email', [LoginController::class, 'sentEmail'])->name('admin.sent_email');
Route::get('/admin/otp-validation', [LoginController::class, 'otp'])->name('admin.otp');
Route::post('/admin/otp-validation-process', [LoginController::class, 'otpValidation'])->name('admin.otp-validate');
Route::get('/admin/reset-password', [LoginController::class, 'reset'])->name('admin.reset-password-confirm');
Route::post('/admin/reset-password/confirm', [LoginController::class, 'resetPassword'])->name('admin.reset-password-success');



Route::get('/admin/register', [RegisterController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [RegisterController::class, 'register']);
