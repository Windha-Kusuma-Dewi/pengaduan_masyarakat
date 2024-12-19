<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

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
    return view('landing-page');
});
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login/auth', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class,'logout'])->name('logout');

Route::middleware(['isLogin'])->group(function () {
    // Route::middleware(['isGuest'])->group(function() {
    Route::get('/report/article', [ReportController::class, 'index'])->name('report.article');
    Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
    Route::get('report/search', [ReportController::class, 'searchByProvince'])->name('report.search');

    Route::get('/report/show/{id}', [ReportController::class, 'show'])->name('report.show');
    Route::post('/report/show/{id}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/monitoring', [ReportController::class, 'monitoring'])->name('monitoring');
    // Route::post('/report/vote', [ReportController::class, 'vote'])->name('report.vote');
    // });
});
