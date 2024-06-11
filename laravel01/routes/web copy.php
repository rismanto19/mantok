<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () {
    return "Halaman About";

});

Route::get ('profil', function () {
    return view('Profil');
});

// Route dengan parameter
Route::get('welcome/{salam}', function ($salam) {
    // return 'Selamat '. $salam;
    return view('salam')->with('viewsalam', $salam);
});

// Route tanpa parameter
// terdapat array List
Route::get('listdata', function () {
    $list = ["Sistem Informasi", "Informatika", "Manajemen"];
    $listmhs = [
        ["npm" => 001, "nama" => "Ilham"],
        ["npm" => 002, "nama" => "Swan"]    
    ];
    return view('listprodi')
        ->with('viewlist', $list)
        ->with('viewmhs', $listmhs);
});

Route::resource('fakultas', FakultasController::class);
Route::resource('prodi', ProdiController::class);
Route::resource('mahasiswa',MahasiswaController::class);
Route::get('dashboard', [DashboardController::class, 'index']);