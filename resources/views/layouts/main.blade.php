<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Het Bier Blog</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet"/>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['"Playfair Display"', 'serif'],
            body: ['Lato', 'sans-serif'],
          },
          colors: {
            cream: '#f7f3ec',
            amber: {
              50: '#fdf8ef',
              100: '#f9eedb',
              200: '#f2d9ac',
              300: '#e9bf74',
              400: '#dfa040',
              500: '#c8851e',
              600: '#a86714',
              700: '#864f12',
              800: '#6e4015',
              900: '#5c3614',
            },
            bark: {
              900: '#1a1208',
              800: '#2d1f0d',
              700: '#3d2b12',
            },
          },
        }
      }
    }
  </script>
  <style>
    body {
      background-color: #f7f3ec;
      font-family: 'Lato', sans-serif;
    }

    .grain-overlay {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 50;
      opacity: 0.025;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
      background-repeat: repeat;
      background-size: 128px 128px;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 40px rgba(26,18,8,0.12);
    }

    .card-link::after {
      content: '';
      display: block;
      width: 0;
      height: 1px;
      background: #c8851e;
      transition: width 0.3s ease;
      margin-top: 2px;
    }

    .card-link:hover::after {
      width: 100%;
    }

    .divider-ornament {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #a86714;
    }

    .divider-ornament::before,
    .divider-ornament::after {
      content: '';
      flex: 1;
      height: 1px;
      background: linear-gradient(to right, transparent, #c8851e60, transparent);
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .fade-up {
      animation: fadeUp 0.6s ease both;
    }

    .card:nth-child(1) { animation-delay: 0.05s; }
    .card:nth-child(2) { animation-delay: 0.12s; }
    .card:nth-child(3) { animation-delay: 0.19s; }
    .card:nth-child(4) { animation-delay: 0.26s; }
    .card:nth-child(5) { animation-delay: 0.33s; }
    .card:nth-child(6) { animation-delay: 0.40s; }

    .badge-published {
      background: #f2d9ac;
      color: #864f12;
      border: 1px solid #e9bf74;
    }

    .badge-draft {
      background: #f0ede8;
      color: #8a7968;
      border: 1px solid #d9d3ca;
    }

    .hop-icon {
      opacity: 0.07;
      position: absolute;
      right: -20px;
      bottom: -20px;
      width: 120px;
      height: 120px;
      pointer-events: none;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col text-bark-900">

  <!-- Grain texture overlay -->
  <div class="grain-overlay"></div>

  <!-- Header -->
  <header class="border-b border-amber-200 bg-cream/90 backdrop-blur-sm sticky top-0 z-40">
    <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <svg class="w-7 h-7 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M5 3h14v2a7 7 0 0 1-7 7 7 7 0 0 1-7-7V3z" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 12v9M8 21h8" stroke-linecap="round"/>
          <path d="M19 7h2a2 2 0 0 1 0 4h-2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div>
          <span class="font-display text-xl font-semibold tracking-tight text-bark-900">Het Plezier &amp; Bier</span>
          <span class="hidden sm:inline text-amber-600 font-display italic text-sm ml-2">Blog</span>
        </div>
      </div>
      <span class="text-xs tracking-widest uppercase text-amber-700 font-body font-light">Est. 2024</span>
    </div>
  </header>

  <!-- Main -->
  <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-16">


   @yield('content')

  </main>

  <!-- Footer -->
  <footer class="border-t border-amber-200 mt-16">
    <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col sm:flex-row items-center justify-between gap-3">
      <span class="font-display italic text-amber-700 text-sm">The Hop &amp; Grain Journal</span>
      <p class="text-xs text-bark-700 font-body font-light tracking-wide">
        &copy; 2025 &mdash; Crafted with care &amp; curiosity
      </p>
    </div>
  </footer>

</body>
</html>