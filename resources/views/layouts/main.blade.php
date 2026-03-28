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
 
        /* Prose content styles for the post body */
        .post-content h1, .post-content h2, .post-content h3, .post-content h4 {
            font-family: 'Playfair Display', serif;
            color: #1a1208;
            margin-top: 2em;
            margin-bottom: 0.6em;
            line-height: 1.3;
        }
        .post-content h2 { font-size: 1.5rem; font-weight: 600; }
        .post-content h3 { font-size: 1.2rem; font-weight: 600; }
 
        .post-content p {
            margin-bottom: 1.5em;
            line-height: 1.85;
            color: #3d2b12;
            font-weight: 300;
        }
 
        .post-content a {
            color: #a86714;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
 
        .post-content blockquote {
            border-left: 3px solid #e9bf74;
            margin: 2em 0;
            padding: 0.75em 1.5em;
            background: #fdf8ef;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: #6e4015;
            font-size: 1.1rem;
        }
 
        .post-content ul, .post-content ol {
            margin: 1.5em 0;
            padding-left: 1.5em;
            color: #3d2b12;
            font-weight: 300;
            line-height: 1.85;
        }
        .post-content ul { list-style: disc; }
        .post-content ol { list-style: decimal; }
        .post-content li { margin-bottom: 0.4em; }
 
        .post-content strong { font-weight: 700; color: #2d1f0d; }
        .post-content em { font-style: italic; }
 
        .post-content hr {
            border: none;
            border-top: 1px solid #e9bf74;
            margin: 2.5em 0;
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
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.6s ease both; }
        .fade-up-delay { animation: fadeUp 0.6s ease 0.15s both; }
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
      <span class="text-xs tracking-widest uppercase text-amber-700 font-body font-light">Est. 2026</span>
    </div>
  </header>

  <!-- Main -->
  <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-16">


   @yield('content')

  </main>

  <!-- Footer -->
  <footer class="border-t border-amber-200 mt-16">
    <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col sm:flex-row items-center justify-between gap-3">
      <span class="font-display italic text-amber-700 text-sm">Het Bier &amp; Plezier Blog</span>
      <p class="text-xs text-bark-700 font-body font-light tracking-wide">
        &copy; 2026 &mdash; Crafted with care &amp; curiosity
      </p>
    </div>
  </footer>

</body>
</html>