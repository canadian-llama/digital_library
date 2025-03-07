<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/landing', function () {
        $currentUser = Auth::user();
        // dd($currentUser->role);
        if ($currentUser->role === 'admin') {
            return view('admin.index');
        }
        return redirect()->route('user.dashboard');
    })->name('home');


    // User routes
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/user/search', [BookController::class, 'search'])->name('book.search');

    Route::get('/admin/{var}', [UserController::class, 'show'])->name('admin.show');
    
    Route::get('/admin/edit-user/{id}', [UserController::class, 'edit'])->name('admin.edit');

    Route::get('/admin/edit-books/{id}', [BookController::class, 'edit'])->name('book.showEdit');

    Route::get('/user/{var}/{id}', [BookController::class, 'show'])->name('book.show');

    Route::post('/admin/update-user/{id}', [UserController::class, 'update'])->name('admin.update');

    Route::post('/admin/delete-user/{id}', [UserController::class, 'delete'])->name('admin.delete');

    Route::post('/admin/add-user', [UserController::class, 'store'])->name('createUsers');

    Route::post('/download/{id}', [BookController::class, 'download'])->name('download');

    Route::post('/admin/edit-book/{id}', [BookController::class, 'update'])->name('book.edit');

    Route::post('/admin/add-book', [BookController::class, 'store'])->name('storeBooks');
 
    Route::post('/admin/delete-book/{id}', [BookController::class, 'delete'])->name('book.delete');

    Route::get('/user/follow-user/{userid}/{followerid}', [UserController::class, 'follow'])->name('user.follow');

    Route::get('/user/unfollow-user/{userid}/{followerid}', [UserController::class, 'unfollow'])->name('user.unfollow');

    Route::get('/user/favorite/{userid}/{bookid}', [BookController::class, 'favorite'])->name('book.favorite');

    Route::post('/user/unfavorite/{userid}/{bookid}', [BookController::class, 'unfavorite'])->name('book.unfavorite');

});




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show.login');

    Route::get('/register', 'showRegister')->name('show.register');

    Route::post('/login', 'login')->name('login');

    Route::post('/register', 'register')->name('register');
});
