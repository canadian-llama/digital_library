<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Livewire\AdminDashboard;
use App\Livewire\CreateBook;
use App\Livewire\CreateUser;
use App\Livewire\Dashboards\UserDashboard;
use App\Livewire\DeactivatedView;
use App\Livewire\Helpers\BookDetails;
use App\Livewire\MyLibrary;
use App\Livewire\Profile;
use App\Livewire\SuspendedView;
use App\Livewire\ViewBook;
use App\Livewire\ViewUser;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('landing');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'validateForgotPassword'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'validateResetPassword'])->middleware('guest')->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/admin-dashboard', AdminDashboard::class)->name('admin-dashboard');
    Route::get('/user-dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('/my-library', MyLibrary::class)->name('book.library');
    Route::get('/profile/{id}', Profile::class)->name('user.profile');
    Route::get('/user/suspended', SuspendedView::class)->name('user.suspended');
    Route::get('/user/deactivated', DeactivatedView::class)->name('user.deactivated');
});

Route::get('/book-details/{id}', BookDetails::class)->name('book.details');
