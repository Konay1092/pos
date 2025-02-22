<?php

use App\Http\Controllers\api\AuthApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/mail', [AuthApiController::class, 'mail']);

Route::get('/admin/login', function () {
    return view('Auth/login');
});
Route::get('/admin/register', function () {
    return view('Auth/register');
});
// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);
