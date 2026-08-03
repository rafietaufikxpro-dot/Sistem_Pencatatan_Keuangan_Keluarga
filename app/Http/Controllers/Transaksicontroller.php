<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    /**
     * Tampil Daftar Transaksi
     * GET /transaksi
     */
    public function index(): View
    {
        $transaksi = Transaksi::orderByDesc('tanggal')->orderByDesc('id')->get();

        $totalPemasukan = $transaksi->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('transaksi.index', compact(
            'transaksi',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));
    }

    /**
     * Form Tambah Transaksi
     * GET /transaksi/create
     */
    public function create(): View
    {
        return view('transaksi.create');
    }

    /**
     * Simpan Transaksi Baru
     * POST /transaksi
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal'     => ['required', 'date'],
            'jenis'       => ['required', 'in:pemasukan,pengeluaran'],
            'nominal'     => ['required', 'integer', 'min:0'],
            'keterangan'  => ['required', 'string', 'max:255'],
        ]);

        Transaksi::create($validated);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Form Edit Transaksi
     * GET /transaksi/{transaksi}/edit
     */
    public function edit(Transaksi $transaksi): View
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update Transaksi
     * PUT/PATCH /transaksi/{transaksi}
     */
    public function update(Request $request, Transaksi $transaksi): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal'     => ['required', 'date'],
            'jenis'       => ['required', 'in:pemasukan,pengeluaran'],
            'nominal'     => ['required', 'integer', 'min:0'],
            'keterangan'  => ['required', 'string', 'max:255'],
        ]);

        $transaksi->update($validated);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Hapus Transaksi
     * DELETE /transaksi/{transaksi}
     */
    public function destroy(Transaksi $transaksi): RedirectResponse
    {
        $transaksi->delete();

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}