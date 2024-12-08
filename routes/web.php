<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/appointment', function () {
    return view('appointment');
})->middleware(['auth', 'verified'])->name('appointment');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.form');

Route::delete('/patient/{id}', [AppointmentController::class, 'destroy'])->name('patient.destroy');

Route::put('/patient/{id}/approve', [AppointmentController::class, 'approve'])->name('patient.approve');


Route::get('/admin/patient', [AppointmentController::class, 'index'])->name('admin.patient');

Route::get('/admin/patienthistory', [AppointmentController::class, 'adminHistory'])->name('admin.patienthistory');

Route::get('/user/patienthistory', [AppointmentController::class, 'userHistory'])->name('patienthistory');

Route::patch('/appointments/{id}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');

Route::patch('appointments/{id}/cancel', [AppointmentController::class, 'cancelAppointment'])->name('appointments.cancel');

Route::patch('appointments/{id}/done', [AppointmentController::class, 'markAsDone'])->name('appointments.markAsDone');

Route::patch('appointments/{id}/cancel', [AppointmentController::class, 'cancelAppointment'])->name('appointments.cancel');

Route::get('/schedule', [AppointmentController::class, 'userindex'])->name('schedule');
// Admin Dashboard Route
Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';
