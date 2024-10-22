<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParkSpaceController;
use App\Http\Controllers\ParkingRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminBookingController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/add-park-space', [AdminController::class, 'showAddParkSpaceForm'])->name('admin.addParkSpace');
Route::post('/admin/add-park-space', [AdminController::class, 'addParkSpace'])->name('admin.addParkSpace.submit');

Route::get('/view-park', [ParkSpaceController::class, 'index'])->name('view.park');

Route::post('/book-parking', [BookingController::class, 'bookParking'])->name('book.parking');

Route::get('/booking-requests', [ParkingRequestController::class, 'showRequests'])->name('booking.requests');

Route::get('/admin/manageuser', [UserController::class, 'manageUsers'])->name('admin.manageuser');
Route::patch('/admin/manageuser/{id}', [UserController::class, 'updateStatus'])->name('admin.updateStatus');

Route::get('/admin/managespaces', [ParkSpaceController::class, 'manageSpaces'])->name('admin.managespaces');
Route::post('/admin/managespaces/{id}', [ParkSpaceController::class, 'updateSpace'])->name('admin.updateSpace');
Route::delete('/admin/managespaces/{id}', [ParkSpaceController::class, 'deleteSpace'])->name('admin.deleteSpace');

Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

Route::get('/admin/managebookings', [AdminBookingController::class, 'manageBookings'])->name('admin.manageBookings');
Route::post('/admin/update-booking/{id}', [AdminBookingController::class, 'updateBooking'])->name('admin.updateBooking');
Route::post('/admin/delete-booking/{id}', [AdminBookingController::class, 'deleteBooking'])->name('admin.deleteBooking');