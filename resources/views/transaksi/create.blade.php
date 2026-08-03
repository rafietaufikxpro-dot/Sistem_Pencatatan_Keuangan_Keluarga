@extends('layouts.app')

@section('title', 'Tambah Transaksi - Buku Kas Keluarga')

@section('content')

  <div class="max-w-xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="font-display font-semibold text-xl">Tambah Transaksi</h2>
      <a href="{{ route('transaksi.index') }}" class="text-xs font-medium underline decoration-dashed underline-offset-4 text-[var(--ink-soft)]">
        &larr; Kembali ke daftar
      </a>
    </div>

    <form action="{{ route('transaksi.store') }}" method="POST"
          class="border-2 border-[var(--ink)] rounded-md bg-[#FBF9F2] px-6 py-6 space-y-5">
      @csrf

      @include('transaksi._form')

      <div class="flex gap-3 pt-2">
        <a href="{{ route('transaksi.index') }}"
           class="flex-1 text-center border-2 border-[var(--ink)] rounded-sm py-2.5 text-sm font-medium hover:bg-[var(--paper)] transition-colors">
          Batal
        </a>
        <button type="submit"
                class="flex-1 bg-[var(--ink)] text-[var(--paper)] rounded-sm py-2.5 text-sm font-medium hover:bg-[#374449] transition-colors">
          Simpan
        </button>
      </div>
    </form>
  </div>

@endsection