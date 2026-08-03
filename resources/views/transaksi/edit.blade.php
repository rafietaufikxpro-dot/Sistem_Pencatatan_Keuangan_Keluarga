@extends('layouts.app')

@section('title', 'Edit Transaksi - Buku Kas Keluarga')

@section('content')

  <div class="max-w-xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="font-display font-semibold text-xl">Kelola Transaksi</h2>
      <a href="{{ route('transaksi.index') }}" class="text-xs font-medium underline decoration-dashed underline-offset-4 text-[var(--ink-soft)]">
        &larr; Kembali ke daftar
      </a>
    </div>

    <form action="{{ route('transaksi.update', $transaksi) }}" method="POST"
          class="border-2 border-[var(--ink)] rounded-md bg-[#FBF9F2] px-6 py-6 space-y-5">
      @csrf
      @method('PUT')

      @include('transaksi._form')

      <div class="flex gap-3 pt-2">
        <button type="submit"
                class="flex-1 bg-[var(--ink)] text-[var(--paper)] rounded-sm py-2.5 text-sm font-medium hover:bg-[#374449] transition-colors">
          Simpan Perubahan
        </button>
      </div>
    </form>

    <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST"
          onsubmit="return confirm('Hapus transaksi ini? Tindakan ini tidak bisa dibatalkan.');" class="mt-3">
      @csrf
      @method('DELETE')
      <button type="submit"
              class="w-full border-2 border-[var(--expense)] text-[var(--expense)] rounded-sm py-2.5 text-sm font-medium hover:bg-[var(--expense-soft)] transition-colors">
        Hapus Transaksi
      </button>
    </form>
  </div>

@endsection