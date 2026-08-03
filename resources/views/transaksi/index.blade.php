@extends('layouts.app')

@section('title', 'Daftar Transaksi - Buku Kas Keluarga')

@section('content')

  {{-- ============ SALDO PASSBOOK STUB ============ --}}
  <section class="mb-10">
    <div class="stub-edge bg-[#FBF9F2] border-2 border-[var(--ink)] rounded-t-lg px-6 sm:px-10 pt-7 pb-9 shadow-[6px_6px_0_0_rgba(31,42,46,0.9)]">
      <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
        <div>
          <p class="text-[11px] uppercase tracking-[0.18em] text-[var(--ink-soft)] mb-2">Saldo Akhir</p>
          <p class="font-display font-semibold text-4xl sm:text-5xl leading-none"
             style="color: {{ $saldo < 0 ? 'var(--expense)' : 'var(--ink)' }}">
            Rp{{ number_format($saldo, 0, ',', '.') }}
          </p>
          <p class="text-xs text-[var(--ink-soft)] mt-2">Diperbarui otomatis dari seluruh transaksi tercatat</p>
        </div>
        <div class="flex gap-4">
          <div class="border-l-2 border-[var(--paper-line)] pl-4">
            <p class="text-[10px] uppercase tracking-[0.14em] text-[var(--income)] font-semibold mb-1">Pemasukan</p>
            <p class="font-mono font-medium text-lg text-[var(--income)]">+Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
          </div>
          <div class="border-l-2 border-[var(--paper-line)] pl-4">
            <p class="text-[10px] uppercase tracking-[0.14em] text-[var(--expense)] font-semibold mb-1">Pengeluaran</p>
            <p class="font-mono font-medium text-lg text-[var(--expense)]">-Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ============ HEADER + TOMBOL TAMBAH ============ --}}
  <section>
    <div class="flex items-center justify-between mb-4">
      <div>
        <h2 class="font-display font-semibold text-xl">Daftar Transaksi</h2>
        <p class="text-xs text-[var(--ink-soft)] mt-0.5">{{ $transaksi->count() }} transaksi tercatat</p>
      </div>
      <a href="{{ route('transaksi.create') }}"
         class="font-medium text-sm bg-[var(--ink)] text-[var(--paper)] px-4 py-2.5 rounded-sm hover:bg-[#374449] transition-colors flex items-center gap-2">
        <span class="text-base leading-none">+</span> Tambah Transaksi
      </a>
    </div>

    <div class="border-2 border-[var(--ink)] rounded-md overflow-hidden bg-[#FBF9F2]">
      @if ($transaksi->isEmpty())
        <div class="px-6 py-14 text-center">
          <p class="font-display text-lg mb-1">Belum ada catatan</p>
          <p class="text-sm text-[var(--ink-soft)]">Tekan "Tambah Transaksi" untuk mulai mencatat arus kas keluarga.</p>
        </div>
      @else
        {{-- desktop table --}}
        <div class="hidden sm:block">
          <table class="w-full text-sm">
            <thead>
              <tr class="text-left text-[11px] uppercase tracking-[0.08em] text-[var(--ink-soft)] border-b-2 border-[var(--ink)]">
                <th class="px-5 py-3 font-medium">Tanggal</th>
                <th class="px-5 py-3 font-medium">Keterangan</th>
                <th class="px-5 py-3 font-medium">Jenis</th>
                <th class="px-5 py-3 font-medium text-right">Nominal</th>
                <th class="px-5 py-3 font-medium text-right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $t)
                <tr class="ledger-row hover:bg-[var(--paper)] transition-colors">
                  <td class="px-5 py-3.5 font-mono text-xs text-[var(--ink-soft)] whitespace-nowrap">
                    {{ $t->tanggal->translatedFormat('d M Y') }}
                  </td>
                  <td class="px-5 py-3.5">{{ $t->keterangan }}</td>
                  <td class="px-5 py-3.5">
                    <span class="type-pill inline-block text-[11px] px-2.5 py-1 rounded-sm
                      {{ $t->jenis === 'pemasukan' ? 'bg-[var(--income-soft)] text-[var(--income)]' : 'bg-[var(--expense-soft)] text-[var(--expense)]' }}">
                      {{ $t->jenis }}
                    </span>
                  </td>
                  <td class="px-5 py-3.5 text-right font-mono font-medium"
                      style="color: {{ $t->jenis === 'pemasukan' ? 'var(--income)' : 'var(--expense)' }}">
                    {{ $t->jenis === 'pemasukan' ? '+' : '−' }} Rp{{ number_format($t->nominal, 0, ',', '.') }}
                  </td>
                  <td class="px-5 py-3.5 text-right whitespace-nowrap">
                    <a href="{{ route('transaksi.edit', $t) }}"
                       class="text-xs font-medium underline decoration-dashed underline-offset-4 hover:text-[var(--gold)]">Edit</a>
                    <form action="{{ route('transaksi.destroy', $t) }}" method="POST" class="inline"
                          onsubmit="return confirm('Hapus transaksi ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="text-xs font-medium underline decoration-dashed underline-offset-4 text-[var(--expense)] hover:text-[var(--expense)] ml-3">
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- mobile cards --}}
        <div class="sm:hidden divide-y divide-dashed divide-[var(--paper-line)]">
          @foreach ($transaksi as $t)
            <div class="px-5 py-4">
              <div class="flex items-start justify-between gap-3">
                <div>
                  <p class="text-sm font-medium">{{ $t->keterangan }}</p>
                  <p class="font-mono text-[11px] text-[var(--ink-soft)] mt-1">{{ $t->tanggal->translatedFormat('d M Y') }}</p>
                </div>
                <p class="font-mono font-medium text-sm whitespace-nowrap"
                   style="color: {{ $t->jenis === 'pemasukan' ? 'var(--income)' : 'var(--expense)' }}">
                  {{ $t->jenis === 'pemasukan' ? '+' : '−' }} Rp{{ number_format($t->nominal, 0, ',', '.') }}
                </p>
              </div>
              <div class="flex items-center justify-between mt-2">
                <span class="type-pill inline-block text-[10px] px-2 py-0.5 rounded-sm
                  {{ $t->jenis === 'pemasukan' ? 'bg-[var(--income-soft)] text-[var(--income)]' : 'bg-[var(--expense-soft)] text-[var(--expense)]' }}">
                  {{ $t->jenis }}
                </span>
                <div class="flex gap-3">
                  <a href="{{ route('transaksi.edit', $t) }}" class="text-xs font-medium underline decoration-dashed underline-offset-4">Edit</a>
                  <form action="{{ route('transaksi.destroy', $t) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs font-medium underline decoration-dashed underline-offset-4 text-[var(--expense)]">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </section>

@endsection