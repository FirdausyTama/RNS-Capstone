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

// ✅ TAMBAHKAN ROUTE INI UNTUK DETAIL STOK
Route::get('/detail-stok/{id}', function ($id) {
    return view('dokumen.detail-stok');
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
#============================================
#PRINT TEMPLATE==============================
Route::get('/print-sph', function () {
    return view('dokumen.template.print-sph');
});
Route::get('/print-invoice', function () {
    return view('dokumen.template.print-invoice');
});
Route::get('/print-kwitansi', function () {
    return view('dokumen.template.print-kwitansi');
});
Route::get('/print-surat-jalan', function () {
    return view('dokumen.template.print-surat-jalan');
});
#============================================
#KELOLA ADMIN================================
Route::get('/kelola-admin', function () {
    return view('kelola-admin');
});
Route::get('/eror-404', function () {
    return view('eror-404');
});

Route::get('/stok/detail-stok/{id}', function() {
    return view('stok.detail-stok');
})->name('stok.detail');