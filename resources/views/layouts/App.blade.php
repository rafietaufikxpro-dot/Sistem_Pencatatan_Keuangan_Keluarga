<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Buku Kas Keluarga')</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Public+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --paper:#F1EEE1;
    --paper-line:#DCD5BC;
    --ink:#1F2A2E;
    --ink-soft:#5B6660;
    --income:#2F6F4E;
    --income-soft:#E4EEE5;
    --expense:#A8402F;
    --expense-soft:#F4E4DE;
    --gold:#B8902E;
    --gold-soft:#F1E6C8;
  }
  body{ background:var(--paper); color:var(--ink); font-family:'Public Sans',sans-serif; }
  .font-display{ font-family:'Fraunces',serif; }
  .font-mono{ font-family:'IBM Plex Mono',monospace; font-variant-numeric: tabular-nums; }

  .stub-edge{ position:relative; }
  .stub-edge::after{
    content:"";
    position:absolute;
    left:0; right:0; bottom:-1px;
    height:16px;
    background-image: radial-gradient(circle, var(--paper) 5px, transparent 5.5px);
    background-size: 22px 22px;
    background-position: -3px 6px;
  }

  .ledger-row{ border-bottom:1px dashed var(--paper-line); }
  .ledger-row:last-child{ border-bottom:none; }
  .type-pill{ font-family:'IBM Plex Mono',monospace; letter-spacing:0.02em; }
</style>
@stack('styles')
</head>
<body class="min-h-screen flex flex-col">

{{-- ============ NAVBAR / HEADER ============ --}}
<header class="border-b-2 border-[var(--ink)] bg-[var(--paper)] sticky top-0 z-30">
  <div class="max-w-5xl mx-auto px-5 sm:px-8 py-4 flex items-center justify-between">
    <a href="{{ route('transaksi.index') }}" class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-sm border-2 border-[var(--ink)] flex items-center justify-center font-display font-semibold text-sm">Rp</div>
      <div>
        <h1 class="font-display font-semibold text-lg leading-none">Buku Kas Keluarga</h1>
        <p class="text-[11px] uppercase tracking-[0.14em] text-[var(--ink-soft)] mt-1">Catatan arus kas rumah tangga</p>
      </div>
    </a>
    <div class="font-mono text-xs text-[var(--ink-soft)] hidden sm:block">
      {{ now()->translatedFormat('l, d F Y') }}
    </div>
  </div>
</header>

{{-- ============ CONTENT ============ --}}
<main class="max-w-5xl mx-auto w-full px-5 sm:px-8 py-8 sm:py-10 flex-1">

  @if (session('success'))
    <div class="mb-6 border-2 border-[var(--income)] bg-[var(--income-soft)] text-[var(--income)] rounded-sm px-4 py-3 text-sm font-medium">
      {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="mb-6 border-2 border-[var(--expense)] bg-[var(--expense-soft)] text-[var(--expense)] rounded-sm px-4 py-3 text-sm">
      <p class="font-medium mb-1">Periksa kembali isian berikut:</p>
      <ul class="list-disc list-inside space-y-0.5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @yield('content')

</main>

{{-- ============ FOOTER ============ --}}
<footer class="border-t-2 border-[var(--paper-line)] py-6">
  <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center text-xs text-[var(--ink-soft)]">
    Sistem Pencatatan Keuangan Keluarga &middot; dibuat dengan Laravel &amp; Blade
  </div>
</footer>

@stack('scripts')
</body>
</html>