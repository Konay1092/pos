<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\brand\BrandApiController;
use App\Http\Controllers\api\Category\CategoryApiController;
use App\Http\Controllers\api\main_category\MainCategoryApiController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);
Route::post('logout', [AuthApiController::class, 'logout']);

Route::post('/forgotpassword', [AuthApiController::class, 'sendResetLinkEmail']);
Route::post('/otp-validation', [AuthApiController::class, 'otpValidation']);
Route::post('/reset-password', [AuthApiController::class, 'resetPassword']);

// User Not Login

// For Brand
Route::get('/all-brands', [BrandApiController::class, 'index']);
Route::get('/all-brands/{id}', [BrandApiController::class, 'getBrand']);

// For Main Category
Route::get('/main-category', [MainCategoryApiController::class, 'index']);

// For Category
Route::get('/all-categories', [CategoryApiController::class, 'index']);
Route::get('/all-categories/{id}', [CategoryApiController::class, 'getCategory']);

//For Home
Route::get('/home', [MainCategoryApiController::class, 'home']);


Route::middleware('auth')->group(
    function () {

        Route::post('/change-password', [AuthApiController::class, 'changePassword']);

        // For Brand
        // For MainCategory

        // For  Main Category

        // For Product


        // For Order


        // For Payment


    }
);





// For Brand

# MAIL_MAILER=smtp
# MAIL_HOST=sandbox.smtp.mailtrap.io
# MAIL_PORT=2525
# MAIL_USERNAME=24b2cb7e3e4fc3
# MAIL_PASSWORD=e076c8d26fbc56
# MAIL_ENCRYPTION=null
# MAIL_FROM_ADDRESS="hello@example.com"
# MAIL_FROM_NAME="${APP_NAME}"
