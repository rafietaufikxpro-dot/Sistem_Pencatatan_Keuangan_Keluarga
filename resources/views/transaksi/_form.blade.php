{{-- Partial form: dipakai oleh create.blade.php dan edit.blade.php --}}

<div>
  <label class="block text-[11px] uppercase tracking-[0.1em] text-[var(--ink-soft)] mb-2">Tanggal</label>
  <input required type="date" name="tanggal"
         value="{{ old('tanggal', isset($transaksi) ? $transaksi->tanggal->format('Y-m-d') : now()->format('Y-m-d')) }}"
         class="w-full border-2 border-[var(--ink)] rounded-sm px-3 py-2.5 bg-[#FBF9F2] font-mono text-sm focus:outline-none focus:ring-2 focus:ring-[var(--gold)]">
</div>

<div>
  <label class="block text-[11px] uppercase tracking-[0.1em] text-[var(--ink-soft)] mb-2">Jenis</label>
  @php $jenisLama = old('jenis', $transaksi->jenis ?? ''); @endphp
  <div class="grid grid-cols-2 gap-2">
    <label class="cursor-pointer">
      <input type="radio" name="jenis" value="pemasukan" class="peer sr-only" {{ $jenisLama === 'pemasukan' ? 'checked' : '' }}>
      <div class="border-2 border-[var(--income)] text-[var(--income)] rounded-sm py-2.5 text-sm font-medium text-center transition-colors
                  peer-checked:bg-[var(--income)] peer-checked:text-[var(--paper)]">
        Pemasukan
      </div>
    </label>
    <label class="cursor-pointer">
      <input type="radio" name="jenis" value="pengeluaran" class="peer sr-only" {{ $jenisLama === 'pengeluaran' ? 'checked' : '' }}>
      <div class="border-2 border-[var(--expense)] text-[var(--expense)] rounded-sm py-2.5 text-sm font-medium text-center transition-colors
                  peer-checked:bg-[var(--expense)] peer-checked:text-[var(--paper)]">
        Pengeluaran
      </div>
    </label>
  </div>
</div>

<div>
  <label class="block text-[11px] uppercase tracking-[0.1em] text-[var(--ink-soft)] mb-2">Nominal (Rp)</label>
  <input required type="number" min="0" name="nominal" placeholder="0"
         value="{{ old('nominal', $transaksi->nominal ?? '') }}"
         class="w-full border-2 border-[var(--ink)] rounded-sm px-3 py-2.5 bg-[#FBF9F2] font-mono text-sm focus:outline-none focus:ring-2 focus:ring-[var(--gold)]">
</div>

<div>
  <label class="block text-[11px] uppercase tracking-[0.1em] text-[var(--ink-soft)] mb-2">Keterangan</label>
  <textarea required name="keterangan" rows="3" placeholder="Contoh: Gaji bulanan, Token listrik, dsb."
            class="w-full border-2 border-[var(--ink)] rounded-sm px-3 py-2.5 bg-[#FBF9F2] text-sm resize-none focus:outline-none focus:ring-2 focus:ring-[var(--gold)]">{{ old('keterangan', $transaksi->keterangan ?? '') }}</textarea>
</div>