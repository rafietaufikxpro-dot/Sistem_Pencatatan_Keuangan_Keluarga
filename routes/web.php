<?php

use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('transaksi.index');
});

// Resource route otomatis mendaftarkan:
// GET    /transaksi              -> index()
// GET    /transaksi/create       -> create()
// POST   /transaksi              -> store()
// GET    /transaksi/{id}/edit    -> edit()
// PUT    /transaksi/{id}         -> update()
// DELETE /transaksi/{id}         -> destroy()
Route::resource('transaksi', TransaksiController::class)
    ->except(['show']); // tidak butuh halaman detail tunggal untuk MVP ini