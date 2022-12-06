<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Mail\MailController as MailMailController;

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

Route::get('',[WebsiteController::class,'index']);
Route::post('',[WebsiteController::class,'store'])->name('file.store');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/dashboard-decline', [AdminController::class, 'decline'])->name('admin.decline');
    Route::get('/dashboard-approved', [AdminController::class, 'getApproved'])->name('admin.getApproved');
    Route::get('/dashboard-declined', [AdminController::class, 'getDeclined'])->name('admin.getDeclined');
    Route::get('/dashboard-award', [AdminController::class, 'giveAward'])->name('admin.giveAward');
    Route::post('/dashboard-notification', [AdminController::class, 'notification'])->name('admin.notification');
    Route::get('/dashboard-awarded', [AdminController::class, 'getAwarded'])->name('admin.getAwarded');
    Route::post('/dashboard-change', [AdminController::class, 'declineApprove'])->name('admin.declineApprove');
    Route::get('/export', [AdminController::class, 'export'])->name('export');
});

require __DIR__.'/auth.php';
