<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hop & Barrel – Beer Blog</title>

    {{-- Tailwind CDN (replace with compiled asset in production) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Source+Serif+4:ital,opsz,wght@0,8..60,300;0,8..60,400;0,8..60,600;1,8..60,300;1,8..60,400&family=Barlow+Condensed:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber:  { 50:'#fffbeb', 100:'#fef3c7', 200:'#fde68a', 300:'#fcd34d', 400:'#fbbf24', 500:'#f59e0b', 600:'#d97706', 700:'#b45309', 800:'#92400e', 900:'#78350f' },
                        malt:   { 50:'#fdf8f0', 100:'#f8edda', 200:'#f0d9b0', 300:'#e4bd7e', 400:'#d69c4e', 500:'#c47e2e', 600:'#a86424', 700:'#8a4e1e', 800:'#6e3e1a', 900:'#3d2008' },
                        stout:  { 50:'#f4f0ec', 100:'#e4ddd3', 200:'#c8bba5', 300:'#a99270', 400:'#8d7051', 500:'#6d5438', 600:'#523e28', 700:'#3a2c1c', 800:'#251c10', 900:'#120d06' },
                        foam:   '#f7f2e8',
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        body:    ['"Source Serif 4"', 'Georgia', 'serif'],
                        label:   ['"Barlow Condensed"', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        /* ─── CSS variables ─────────────────────────────────────── */
        :root {
            --bg:        #1a0f05;
            --surface:   #231508;
            --card:      #2c1b0d;
            --border:    #3d2810;
            --amber:     #f59e0b;
            --amber-dim: #b45309;
            --foam:      #f7f2e8;
            --muted:     #a88060;
        }

        body { background-color: var(--bg); color: var(--foam); }

        /* ─── Grain overlay ─────────────────────────────────────── */
        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
            opacity: 0.04;
        }

        /* ─── Hero hop ring ─────────────────────────────────────── */
        .hop-ring {
            width: 520px; height: 520px;
            border-radius: 50%;
            border: 1px solid rgba(245,158,11,0.12);
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%,-50%);
            animation: spin 40s linear infinite;
        }
        .hop-ring:nth-child(2) { width: 380px; height: 380px; border-color: rgba(245,158,11,0.18); animation-direction: reverse; animation-duration: 28s; }
        .hop-ring:nth-child(3) { width: 240px; height: 240px; border-color: rgba(245,158,11,0.28); animation-duration: 18s; }
        @keyframes spin { to { transform: translate(-50%,-50%) rotate(360deg); } }

        /* ─── Card hover lift ───────────────────────────────────── */
        .post-card {
            background: var(--card);
            border: 1px solid var(--border);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .post-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(245,158,11,0.25);
            border-color: rgba(245,158,11,0.3);
        }

        /* ─── Featured card shimmer ─────────────────────────────── */
        .featured-card::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, transparent 60%, rgba(245,158,11,0.05) 100%);
            pointer-events: none;
        }

        /* ─── Tag pill ──────────────────────────────────────────── */
        .tag-pill {
            background: rgba(245,158,11,0.12);
            color: var(--amber);
            border: 1px solid rgba(245,158,11,0.22);
            transition: background 0.2s, color 0.2s;
        }
        .tag-pill:hover, .tag-pill.active {
            background: var(--amber);
            color: var(--bg);
        }

        /* ─── Divider rule ──────────────────────────────────────── */
        .rule {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border) 20%, var(--amber-dim) 50%, var(--border) 80%, transparent);
        }

        /* ─── ABV meter ─────────────────────────────────────────── */
        .abv-bar { background: rgba(245,158,11,0.15); }
        .abv-fill { background: linear-gradient(90deg, var(--amber-dim), var(--amber)); }

        /* ─── Scroll reveal ─────────────────────────────────────── */
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ─── Search box ────────────────────────────────────────── */
        .search-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            color: var(--foam);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-box:focus {
            outline: none;
            border-color: rgba(245,158,11,0.4);
            box-shadow: 0 0 0 3px rgba(245,158,11,0.08);
        }
        .search-box::placeholder { color: var(--muted); }

        /* ─── Pagination button ─────────────────────────────────── */
        .pg-btn {
            background: var(--card); border: 1px solid var(--border);
            color: var(--muted);
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .pg-btn:hover, .pg-btn.active { background: var(--amber); color: var(--bg); border-color: var(--amber); }

        /* ─── Page load stagger ─────────────────────────────────── */
        @keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }
        .stagger { opacity:0; animation: fadeUp 0.7s ease forwards; }
        .stagger:nth-child(1) { animation-delay: 0.05s; }
        .stagger:nth-child(2) { animation-delay: 0.15s; }
        .stagger:nth-child(3) { animation-delay: 0.25s; }
        .stagger:nth-child(4) { animation-delay: 0.35s; }
        .stagger:nth-child(5) { animation-delay: 0.45s; }
        .stagger:nth-child(6) { animation-delay: 0.55s; }
    </style>
</head>

<body class="font-body antialiased min-h-screen relative">

    {{-- ═══════════════════════════════════════════════════════════
         NAVIGATION
    ═══════════════════════════════════════════════════════════════ --}}
    <nav class="fixed top-0 inset-x-0 z-50" style="background:rgba(26,15,5,0.85); backdrop-filter:blur(16px); border-bottom:1px solid var(--border);">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <svg class="w-8 h-8 text-amber-500 group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 2a1 1 0 000 2v1a3 3 0 000 6v8a1 1 0 002 0v-8a3 3 0 000-6V4a1 1 0 000-2H6zm10 0a1 1 0 00-1 1v1.17A3.001 3.001 0 0014 7v1a3 3 0 001 2.83V19a1 1 0 002 0v-8.17A3.001 3.001 0 0018 8V7a3.001 3.001 0 00-1-2.83V3a1 1 0 00-1-1h-1z"/>
                </svg>
                <span class="font-display font-bold text-xl tracking-tight" style="color:var(--foam);">
                    Hop<span class="text-amber-500">&amp;</span>Barrel
                </span>
            </a>

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center gap-8 font-label text-sm tracking-widest uppercase">
                @foreach([
                    ['route' => 'home',     'label' => 'Home'],
                    ['route' => 'posts.index', 'label' => 'Blog'],
                    ['route' => 'reviews',  'label' => 'Reviews'],
                    ['route' => 'breweries','label' => 'Breweries'],
                    ['route' => 'about',    'label' => 'About'],
                ] as $link)
                    <a href="{{ route($link['route']) }}"
                       class="transition-colors duration-200 hover:text-amber-400
                              {{ request()->routeIs($link['route']) ? 'text-amber-500 font-semibold' : 'text-muted' }}"
                       style="{{ request()->routeIs($link['route']) ? '' : 'color:var(--muted)' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- CTA --}}
            <a href="{{ route('newsletter') }}"
               class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-sm font-label text-sm tracking-widest uppercase font-semibold transition-colors duration-200"
               style="background:var(--amber); color:var(--bg);">
                Subscribe
            </a>

            {{-- Mobile hamburger --}}
            <button id="nav-toggle" class="md:hidden p-2 rounded" style="color:var(--foam);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 flex flex-col gap-3 font-label text-sm tracking-widest uppercase" style="color:var(--muted);">
            <a href="{{ route('home') }}"        class="hover:text-amber-400 transition-colors">Home</a>
            <a href="{{ route('posts.index') }}" class="text-amber-500 font-semibold">Blog</a>
            <a href="{{ route('reviews') }}"     class="hover:text-amber-400 transition-colors">Reviews</a>
            <a href="{{ route('breweries') }}"   class="hover:text-amber-400 transition-colors">Breweries</a>
            <a href="{{ route('about') }}"       class="hover:text-amber-400 transition-colors">About</a>
        </div>
    </nav>


    {{-- ═══════════════════════════════════════════════════════════
         HERO
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative flex flex-col items-center justify-center text-center overflow-hidden"
             style="min-height:56vh; padding-top:6rem; background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(180,83,9,0.18) 0%, transparent 70%);">

        {{-- Decorative rings --}}
        <div class="pointer-events-none select-none absolute inset-0 flex items-center justify-center">
            <div class="hop-ring"></div>
            <div class="hop-ring"></div>
            <div class="hop-ring"></div>
        </div>

        <div class="relative z-10 max-w-2xl px-6">
            <p class="font-label text-xs tracking-[0.3em] uppercase mb-4" style="color:var(--amber);">
                The Cellar Library
            </p>
            <h1 class="font-display font-black leading-none mb-6" style="font-size: clamp(3rem, 8vw, 5.5rem); color:var(--foam);">
                All Posts
            </h1>
            <p class="font-body text-lg leading-relaxed max-w-lg mx-auto" style="color:var(--muted);">
                Tasting notes, brewery stories, hop science, and the occasional late-night
                review written with a pint in hand.
            </p>
        </div>

        {{-- bottom fade --}}
        <div class="absolute bottom-0 inset-x-0 h-24" style="background:linear-gradient(to bottom, transparent, var(--bg));"></div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════
         FILTERS & SEARCH
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <div class="rule mb-8"></div>

        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between mb-10">

            {{-- Tag filters --}}
            <div class="flex flex-wrap gap-2">
                @php
                    $tags = ['All', 'IPA', 'Stout', 'Lager', 'Sour', 'Barrel-Aged', 'Craft', 'Belgian', 'Session'];
                    $activeTag = request('tag', 'All');
                @endphp
                @foreach($tags as $tag)
                    <a href="{{ route('posts.index', ['tag' => $tag === 'All' ? null : $tag]) }}"
                       class="tag-pill font-label text-xs tracking-widest uppercase px-3 py-1 rounded-sm cursor-pointer {{ $activeTag === $tag ? 'active' : '' }}">
                        {{ $tag }}
                    </a>
                @endforeach
            </div>

            {{-- Search --}}
            <form method="GET" action="{{ route('posts.index') }}" class="flex gap-2 w-full md:w-auto">
                @if(request('tag'))
                    <input type="hidden" name="tag" value="{{ request('tag') }}">
                @endif
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Search posts…"
                       class="search-box font-body text-sm px-4 py-2 rounded-sm w-full md:w-56">
                <button type="submit" class="px-4 py-2 rounded-sm font-label text-xs tracking-widest uppercase font-semibold transition-colors duration-200"
                        style="background:var(--amber); color:var(--bg);">Go</button>
            </form>
        </div>
    </div>


    {{-- ═══════════════════════════════════════════════════════════
         FEATURED POST
    ═══════════════════════════════════════════════════════════════ --}}
    @if(isset($featured))
    <div class="relative z-10 max-w-7xl mx-auto px-6 mb-14">
        <a href="{{ route('posts.show', $featured->slug) }}"
           class="featured-card post-card relative flex flex-col md:flex-row overflow-hidden rounded-sm block">

            {{-- Image --}}
            <div class="relative md:w-1/2 h-64 md:h-auto overflow-hidden" style="min-height:320px;">
                <img src="{{ $featured->thumbnail ?? 'https://images.unsplash.com/photo-1608270586620-248524c67de9?w=800&q=80' }}"
                     alt="{{ $featured->title }}"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                <div class="absolute inset-0" style="background:linear-gradient(90deg,transparent 60%,var(--card));"></div>
                <div class="absolute top-4 left-4">
                    <span class="font-label text-xs tracking-widest uppercase px-3 py-1 rounded-sm font-semibold"
                          style="background:var(--amber); color:var(--bg);">Featured</span>
                </div>
            </div>

            {{-- Content --}}
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-4">
                    <span class="tag-pill font-label text-xs tracking-widest uppercase px-3 py-1 rounded-sm">
                        {{ $featured->category ?? 'IPA' }}
                    </span>
                    <span class="font-label text-xs tracking-wider" style="color:var(--muted);">
                        {{ $featured->reading_time ?? '8' }} min read
                    </span>
                </div>
                <h2 class="font-display font-bold leading-tight mb-4" style="font-size:clamp(1.5rem,3vw,2.25rem); color:var(--foam);">
                    {{ $featured->title ?? 'The Double IPA That Changed Everything' }}
                </h2>
                <p class="font-body leading-relaxed mb-6" style="color:var(--muted); font-size:1rem;">
                    {{ $featured->excerpt ?? 'A deep dive into the haze-bomb revolution — how murky, juicy IPAs toppled decades of clear-beer orthodoxy and rewired craft drinking.' }}
                </p>

                {{-- ABV meter --}}
                @if(isset($featured->abv))
                <div class="mb-6">
                    <div class="flex justify-between font-label text-xs tracking-wider uppercase mb-1" style="color:var(--muted);">
                        <span>ABV</span><span style="color:var(--amber);">{{ $featured->abv }}%</span>
                    </div>
                    <div class="abv-bar h-1 rounded-full overflow-hidden">
                        <div class="abv-fill h-full rounded-full" style="width:{{ min($featured->abv * 10, 100) }}%"></div>
                    </div>
                </div>
                @endif

                <div class="flex items-center gap-3 mt-auto">
                    <img src="{{ $featured->author_avatar ?? 'https://i.pravatar.cc/40?img=12' }}"
                         alt="{{ $featured->author_name ?? 'Editor' }}"
                         class="w-9 h-9 rounded-full object-cover" style="border:2px solid var(--amber-dim);">
                    <div>
                        <p class="font-label text-sm font-semibold" style="color:var(--foam);">
                            {{ $featured->author_name ?? 'Finn O\'Mara' }}
                        </p>
                        <p class="font-label text-xs" style="color:var(--muted);">
                            {{ optional($featured->published_at)->format('M j, Y') ?? 'March 15, 2025' }}
                        </p>
                    </div>
                    <span class="ml-auto font-label text-xs tracking-widest uppercase font-semibold" style="color:var(--amber);">
                        Read More →
                    </span>
                </div>
            </div>
        </a>
    </div>
    @endif


    {{-- ═══════════════════════════════════════════════════════════
         POSTS GRID
    ═══════════════════════════════════════════════════════════════ --}}
    <main class="relative z-10 max-w-7xl mx-auto px-6 pb-24">

        {{-- Results count --}}
        <div class="flex items-center justify-between mb-8">
            <p class="font-label text-sm tracking-wider uppercase" style="color:var(--muted);">
                @if(isset($posts))
                    {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} found
                @else
                    6 posts found
                @endif
            </p>
            <select class="search-box font-label text-xs tracking-widest uppercase px-3 py-2 rounded-sm cursor-pointer"
                    onchange="window.location=this.value">
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}">Latest First</option>
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">Most Popular</option>
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'rating']) }}">Highest Rated</option>
            </select>
        </div>

        {{-- ── If using real data: --}}
        {{-- @forelse($posts as $post) … @empty … @endforelse --}}

        {{-- ── Demo grid (replace with real loop) ── --}}
        @php
        $demo = [
            ['title'=>'Brewing on the Wild Side: Spontaneous Fermentation Explained','category'=>'Sour','excerpt'=>'What happens when you throw open the barn doors and let the universe ferment your beer? We spent a month in Pajottenland finding out.','author'=>'Siobhan Reilly','date'=>'Feb 28, 2025','mins'=>'11','img'=>'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=600&q=80','abv'=>5.2,'rating'=>4.5],
            ['title'=>'Ten Stouts That Will Survive the Apocalypse','category'=>'Stout','excerpt'=>'Big, black, and built to last: an opinionated ranking of barrel-aged imperial stouts that belong in every prepper\'s cellar.','author'=>'Donal Burke','date'=>'Feb 14, 2025','mins'=>'9','img'=>'https://images.unsplash.com/photo-1608270586620-248524c67de9?w=600&q=80','abv'=>12.5,'rating'=>5],
            ['title'=>'The Lager Renaissance Nobody Asked For','category'=>'Lager','excerpt'=>'Craft brewers spent a decade chasing IBUs. Now they\'re spending small fortunes to make beer taste precisely like nothing — and it\'s brilliant.','author'=>'Finn O\'Mara','date'=>'Jan 30, 2025','mins'=>'7','img'=>'https://images.unsplash.com/photo-1535958636474-b021ee887b13?w=600&q=80','abv'=>4.8,'rating'=>4],
            ['title'=>'Cask vs Keg: An Honest Comparison','category'=>'IPA','excerpt'=>'We ordered the same bitter on cask and keg at fourteen pubs across Yorkshire. The results surprised us more than we\'d like to admit.','author'=>'Siobhan Reilly','date'=>'Jan 10, 2025','mins'=>'6','img'=>'https://images.unsplash.com/photo-1567696153798-9111f9cd3d0d?w=600&q=80','abv'=>4.2,'rating'=>4],
            ['title'=>'Belgian Tripels and the Art of Deception','category'=>'Belgian','excerpt'=>'Dangerously drinkable and deceptively strong — a love letter to the most elegant con in brewing.','author'=>'Donal Burke','date'=>'Dec 22, 2024','mins'=>'8','img'=>'https://images.unsplash.com/photo-1436076863939-06870fe779c2?w=600&q=80','abv'=>9.0,'rating'=>4.5],
            ['title'=>'Session Beers: Drinking Responsibly Never Tasted This Good','category'=>'Session','excerpt'=>'Sub-4% ABV used to mean sacrifice. We round up the new generation of session ales that prove low-alcohol can still win big on flavour.','author'=>'Finn O\'Mara','date'=>'Dec 5, 2024','mins'=>'5','img'=>'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=600&q=80','abv'=>3.6,'rating'=>3.5],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($demo as $i => $post)
            <article class="post-card stagger rounded-sm overflow-hidden flex flex-col">

                {{-- Thumbnail --}}
                <a href="#" class="relative block overflow-hidden" style="height:200px;">
                    <img src="{{ $post['img'] }}" alt="{{ $post['title'] }}"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0" style="background:linear-gradient(to top, var(--card) 0%, transparent 60%);"></div>

                    {{-- Category badge --}}
                    <span class="absolute top-3 left-3 tag-pill font-label text-xs tracking-widest uppercase px-2 py-0.5 rounded-sm">
                        {{ $post['category'] }}
                    </span>

                    {{-- Star rating --}}
                    <div class="absolute bottom-3 right-3 flex items-center gap-1">
                        @for($s = 1; $s <= 5; $s++)
                            <svg class="w-3 h-3" fill="{{ $s <= floor($post['rating']) ? 'var(--amber)' : ($s - 0.5 <= $post['rating'] ? 'url(#half)' : 'var(--border)') }}" viewBox="0 0 20 20">
                                <defs>
                                    <linearGradient id="half">
                                        <stop offset="50%" stop-color="var(--amber)"/>
                                        <stop offset="50%" stop-color="var(--border)"/>
                                    </linearGradient>
                                </defs>
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                </a>

                {{-- Body --}}
                <div class="flex flex-col flex-1 p-6">
                    <h3 class="font-display font-bold leading-snug mb-3 hover:text-amber-400 transition-colors duration-200" style="color:var(--foam); font-size:1.1rem;">
                        <a href="#">{{ $post['title'] }}</a>
                    </h3>
                    <p class="font-body text-sm leading-relaxed mb-4 flex-1" style="color:var(--muted);">
                        {{ $post['excerpt'] }}
                    </p>

                    {{-- ABV bar --}}
                    <div class="mb-4">
                        <div class="flex justify-between font-label text-xs tracking-wider uppercase mb-1" style="color:var(--muted);">
                            <span>ABV</span>
                            <span style="color:var(--amber);">{{ $post['abv'] }}%</span>
                        </div>
                        <div class="abv-bar h-0.5 rounded-full overflow-hidden">
                            <div class="abv-fill h-full rounded-full" style="width:{{ min($post['abv'] * 8, 100) }}%"></div>
                        </div>
                    </div>

                    <div class="rule mb-4"></div>

                    {{-- Footer --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://i.pravatar.cc/32?img={{ $i + 3 }}" alt="{{ $post['author'] }}"
                                 class="w-7 h-7 rounded-full object-cover" style="border:1px solid var(--amber-dim);">
                            <div>
                                <p class="font-label text-xs font-semibold" style="color:var(--foam);">{{ $post['author'] }}</p>
                                <p class="font-label text-xs" style="color:var(--muted);">{{ $post['date'] }}</p>
                            </div>
                        </div>
                        <span class="font-label text-xs tracking-wider" style="color:var(--muted);">{{ $post['mins'] }} min</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        {{-- ═══ PAGINATION ════════════════════════════════════════ --}}
        <div class="mt-16 flex items-center justify-center gap-2">
            {{--
                For real Laravel pagination:
                {{ $posts->links('pagination::tailwind') }}
                or with the custom style below:
            --}}

            {{-- Previous --}}
            @if(isset($posts) && $posts->onFirstPage())
                <span class="pg-btn px-4 py-2 rounded-sm font-label text-xs tracking-widest uppercase opacity-30 cursor-not-allowed">← Prev</span>
            @else
                <a href="{{ isset($posts) ? $posts->previousPageUrl() : '#' }}"
                   class="pg-btn px-4 py-2 rounded-sm font-label text-xs tracking-widest uppercase cursor-pointer">← Prev</a>
            @endif

            {{-- Page numbers --}}
            @php $currentPage = isset($posts) ? $posts->currentPage() : 1; @endphp
            @foreach(range(max(1,$currentPage-2), min(max(1,$currentPage-2)+4, isset($posts) ? $posts->lastPage() : 8)) as $page)
                <a href="{{ isset($posts) ? $posts->url($page) : '#' }}"
                   class="pg-btn w-9 h-9 flex items-center justify-center rounded-sm font-label text-xs tracking-widest {{ $page === $currentPage ? 'active' : '' }}">
                    {{ $page }}
                </a>
            @endforeach

            {{-- Next --}}
            @if(isset($posts) && $posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}"
                   class="pg-btn px-4 py-2 rounded-sm font-label text-xs tracking-widest uppercase cursor-pointer">Next →</a>
            @else
                <a href="#" class="pg-btn px-4 py-2 rounded-sm font-label text-xs tracking-widest uppercase cursor-pointer">Next →</a>
            @endif
        </div>

    </main>


    {{-- ═══════════════════════════════════════════════════════════
         NEWSLETTER BANNER
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative z-10 py-20 overflow-hidden" style="background:var(--surface); border-top:1px solid var(--border); border-bottom:1px solid var(--border);">
        <div class="absolute inset-0 opacity-10"
             style="background: radial-gradient(ellipse 70% 80% at 50% 50%, var(--amber) 0%, transparent 70%);"></div>
        <div class="relative max-w-2xl mx-auto px-6 text-center">
            <p class="font-label text-xs tracking-[0.3em] uppercase mb-3" style="color:var(--amber);">Fresh From the Tap</p>
            <h2 class="font-display font-bold mb-4" style="font-size:clamp(2rem,5vw,3rem); color:var(--foam);">
                Never Miss a Pour
            </h2>
            <p class="font-body leading-relaxed mb-8" style="color:var(--muted);">
                Weekly dispatches: new reviews, limited releases, and the occasional recipe for a beer-braised something.
                No spam — just good beer writing.
            </p>
            <form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex gap-3 max-w-md mx-auto">
                @csrf
                <input type="email" name="email" placeholder="your@email.com" required
                       class="search-box font-body text-sm px-4 py-3 rounded-sm flex-1">
                <button type="submit" class="font-label text-sm tracking-widest uppercase font-semibold px-6 py-3 rounded-sm transition-colors duration-200"
                        style="background:var(--amber); color:var(--bg);">
                    Subscribe
                </button>
            </form>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════
         FOOTER
    ═══════════════════════════════════════════════════════════════ --}}
    <footer class="relative z-10 py-12 px-6" style="border-top:1px solid var(--border);">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 2a1 1 0 000 2v1a3 3 0 000 6v8a1 1 0 002 0v-8a3 3 0 000-6V4a1 1 0 000-2H6zm10 0a1 1 0 00-1 1v1.17A3.001 3.001 0 0014 7v1a3 3 0 001 2.83V19a1 1 0 002 0v-8.17A3.001 3.001 0 0018 8V7a3.001 3.001 0 00-1-2.83V3a1 1 0 00-1-1h-1z"/>
                </svg>
                <span class="font-display font-bold" style="color:var(--foam);">Hop<span class="text-amber-500">&amp;</span>Barrel</span>
            </div>
            <p class="font-label text-xs tracking-wider" style="color:var(--muted);">
                © {{ date('Y') }} Hop &amp; Barrel. Drink responsibly. Write irresponsibly.
            </p>
            <div class="flex gap-6 font-label text-xs tracking-widest uppercase" style="color:var(--muted);">
                <a href="{{ route('privacy') }}" class="hover:text-amber-400 transition-colors">Privacy</a>
                <a href="{{ route('contact') }}" class="hover:text-amber-400 transition-colors">Contact</a>
                <a href="{{ route('rss') }}" class="hover:text-amber-400 transition-colors">RSS</a>
            </div>
        </div>
    </footer>


    {{-- ═══════════════════════════════════════════════════════════
         JS: mobile nav + scroll reveal
    ═══════════════════════════════════════════════════════════════ --}}
    <script>
        // Mobile nav toggle
        document.getElementById('nav-toggle')?.addEventListener('click', () => {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });

        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
        }, { threshold: 0.1 });
        reveals.forEach(el => io.observe(el));
    </script>

</body>
</html>