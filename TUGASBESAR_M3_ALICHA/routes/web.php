<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CoachController;

// Halaman utama otomatis mengarah ke Lapangan
Route::get('/', function () {
    return redirect()->route('venues.index');
});

// Lapangan
Route::resource('venues', VenueController::class);

// Rental Alat Olahraga
Route::resource('rentals', RentalItemController::class);

// Member
Route::resource('members', MemberController::class);

// Instruktur/Coach
Route::resource('coaches', CoachController::class);