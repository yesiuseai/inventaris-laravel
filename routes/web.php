<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Models\Barang; // Import Model Barang Secara Resmi
use App\Models\Supplier; // Import Model Supplier Secara Resmi
use Illuminate\Support\Facades\Route;

// Mengarahkan halaman utama langsung ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Halaman Dashboard Berbasis Metrik Finansial & Logistik Real-Time
Route::get('/dashboard', function () {
    // Menghitung jumlah jenis komoditas aman menggunakan Model ter-import
    $totalBarang = Barang::count();
    $totalSupplier = Supplier::count();
    
    // Menghitung barang yang stoknya di bawah atau sama dengan 10 unit (Kritis)
    $stokKritis = Barang::where('stok', '<=', 10)->count();
    
    // Menghitung total nilai aset uang di gudang (Stok x Harga)
    $barangs = Barang::all();
    $totalValuasi = 0;
    foreach ($barangs as $barang) {
        $totalValuasi += ($barang->stok * $barang->harga);
    }

    return view('dashboard', compact('totalBarang', 'totalSupplier', 'stokKritis', 'totalValuasi'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua rute yang dilindungi oleh sistem autentikasi (Auth)
Route::middleware('auth')->group(function () {
    // Rute Manajemen Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Utama: Pendaftaran otomatis rute barang dan supplier
    Route::resource('barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);
});

// Memuat sistem rute bawaan Laravel Breeze
require __DIR__.'/auth.php';