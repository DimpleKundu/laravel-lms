<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookMaintainController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\BorrowBookController;

// Public Routes
Route::view('/', 'auth.login');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for authenticated users
Route::middleware("auth")->group(function () {
    // User Dashboard
    Route::get('/userDashboard', [BookController::class, 'userDashboard'])->name('user.dashboard');
    
    // Admin Dashboard
    Route::get('/adminDashboard', function () {
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('user.dashboard');
        }
        $users = User::all();
        return view('admin-dashboard', compact('users'));
    })->name('admin.dashboard');

    // Book Management Routes
    Route::get('/bookMaintain', [BookMaintainController::class, 'dashboard'])->name('bookMaintain.dashboard');
    Route::get('/books/add', [BookMaintainController::class, 'addBook'])->name('admin.books.add');
    Route::post('/books', [BookMaintainController::class, 'storeBook'])->name('admin.books.store');
    Route::get('/books/{book:bookId}/edit', [BookMaintainController::class, 'editBook'])->name('admin.books.edit');
    Route::put('/books/{book:bookId}', [BookMaintainController::class, 'updateBook'])->name('admin.books.update');
    Route::delete('/books/{book:bookId}', [BookMaintainController::class, 'deleteBook'])->name('admin.books.delete');

    
    // User Management Routes
    Route::get('/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Borrow Book Routes
    Route::post('/books/{book:bookId}/borrow', [BorrowBookController::class, 'store'])->name('books.borrow');
    Route::get('/borrowed-books', [BorrowBookController::class, 'borrowRequest'])->name('user.borrowed-books');

    // Admin Borrow Request Routes
    Route::get('/admin/borrow-requests', [BorrowBookController::class, 'viewBorrowRequests'])->name('admin.borrow-requests');

    // Inside auth middleware group
    Route::post('/admin/borrow/{borrow}/approve', [BorrowBookController::class, 'approveBorrow'])->name('admin.borrow.approve');
    Route::post('/admin/borrow/{borrow}/reject', [BorrowBookController::class, 'rejectBorrow'])->name('admin.borrow.reject');
}
);

