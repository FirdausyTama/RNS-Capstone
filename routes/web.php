<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth.login');
});

Route::get('/register', function () {
    return view('Auth.register');
});

Route::get('/logout', function () {
    return view('Auth.logout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/kelola-stok', function () {
    return view('kelola-stok');
});

Route::get('/detail-stok/{id}', function ($id) {
    return view('dokumen.detail-stok', compact('id'));
})->name('detail.stok');

Route::get('/detail-pembelian/{id}', function ($id) {
    return view('dokumen.detail-pembelian');
})->name('detail.pembelian');

Route::get('/riwayat-pembelian', function () {
    return view('riwayat-pembelian');
});

Route::get('/kelola-pembelian', function () {
    return view('kelola-pembelian');
});

#DOKUMEN====================================
Route::get('/sph', function () {
    return view('dokumen.sph');
});
Route::get('/surat-jalan', function () {
    return view('dokumen.surat-jalan');
});
Route::get('/kwitansi', function () {
    return view('dokumen.kwitansi');
});
Route::get('/invoice', function () {
    return view('dokumen.invoice');
});

// Menjadi ini:
Route::get('/detail-kwitansi/{id}', function ($id) {
    // Validasi ID harus numerik
    if (!is_numeric($id)) {
        return redirect('/kwitansi')->with('error', 'ID Kwitansi tidak valid');
    }
    return view('dokumen.detail-kwitansi', compact('id'));
})->name('detail.kwitansi')->where('id', '[0-9]+');

Route::get('/detail-surat-jalan/{id}', function ($id) {
    if (!is_numeric($id)) {
        return redirect('/surat-jalan')->with('error', 'ID Surat Jalan tidak valid');
    }
    return view('dokumen.detail-surat-jalan', compact('id'));
});

#============================================
#PRINT TEMPLATE==============================
Route::get('/print-sph', function () {
    return view('dokumen.template.print-sph');
});
Route::get('/print-invoice', function () {
    return view('dokumen.template.print-invoice');
});
Route::get('/print-kwitansi/{id?}', function ($id = null) {
    return view('dokumen.template.print-kwitansi', compact('id'));
});
Route::get('/print-surat-jalan/{id?}', function ($id = null) {
    return view('dokumen.template.print-surat-jalan', compact('id'));
});
#============================================
#KELOLA ADMIN================================
Route::get('/kelola-admin', function () {
    return view('kelola-admin');
});
Route::get('/eror-404', function () {
    return view('eror-404');
});

// API Routes for Kwitansi handled by external backend