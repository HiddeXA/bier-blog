@extends('layouts.main')

@section('content')

    <!-- Page heading -->
    <div class="text-center mb-14">
      <p class="text-xs tracking-[0.25em] uppercase text-amber-600 font-body mb-3">Geweldige artikelen Over</p>
      <h1 class="font-display text-5xl font-semibold text-bark-900 leading-tight mb-4">Bier</h1>
      <div class="divider-ornament max-w-xs mx-auto mt-5">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="currentColor">
          <circle cx="8" cy="8" r="3"/><circle cx="2" cy="8" r="1.5"/><circle cx="14" cy="8" r="1.5"/>
        </svg>
      </div>
    </div>
 <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">

      <!-- Card 1 -->
      <article class="card fade-up bg-white rounded-sm shadow-sm border border-amber-100 p-7 relative overflow-hidden flex flex-col">
        <svg class="hop-icon text-amber-400" viewBox="0 0 100 100" fill="currentColor">
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.4" transform="rotate(-30 50 50)"/>
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.3" transform="rotate(30 50 50)"/>
          <ellipse cx="50" cy="50" rx="10" ry="45" opacity="0.5"/>
        </svg>
        <div class="flex items-center justify-between mb-5">
          <span class="badge-published text-xs font-body font-bold tracking-wider uppercase px-2.5 py-1 rounded-full">Published</span>
          <time class="text-xs text-amber-700 font-light font-body">Mar 12, 2025</time>
        </div>
        <h2 class="font-display text-xl font-semibold text-bark-900 leading-snug mb-3">
          <a href="#" class="card-link hover:text-amber-700 transition-colors">The Art of the Belgian Tripel</a>
        </h2>
        <p class="text-sm text-bark-700 font-body font-light leading-relaxed flex-1">
          A deep dive into the golden, effervescent world of Belgian Tripels — their monastic origins, complex yeast character, and why they remain a benchmark of brewing craft.
        </p>
        <div class="mt-6 pt-5 border-t border-amber-100 flex items-center justify-between">
          <span class="text-xs text-amber-600 font-body uppercase tracking-widest">Style Guide</span>
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M17 8l4 4-4 4M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </article>

      <!-- Card 2 -->
      <article class="card fade-up bg-white rounded-sm shadow-sm border border-amber-100 p-7 relative overflow-hidden flex flex-col">
        <svg class="hop-icon text-amber-400" viewBox="0 0 100 100" fill="currentColor">
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.4" transform="rotate(-30 50 50)"/>
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.3" transform="rotate(30 50 50)"/>
          <ellipse cx="50" cy="50" rx="10" ry="45" opacity="0.5"/>
        </svg>
        <div class="flex items-center justify-between mb-5">
          <span class="badge-draft text-xs font-body font-bold tracking-wider uppercase px-2.5 py-1 rounded-full">Draft</span>
          <time class="text-xs text-amber-700 font-light font-body">Mar 8, 2025</time>
        </div>
        <h2 class="font-display text-xl font-semibold text-bark-900 leading-snug mb-3">
          <a href="#" class="card-link hover:text-amber-700 transition-colors">Terroir in Brewing: Myth or Reality?</a>
        </h2>
        <p class="text-sm text-bark-700 font-body font-light leading-relaxed flex-1">
          Can the provenance of water, grain, and hops truly shape a beer's identity the way it does for wine? We explore the growing conversation around regional brewing character.
        </p>
        <div class="mt-6 pt-5 border-t border-amber-100 flex items-center justify-between">
          <span class="text-xs text-amber-600 font-body uppercase tracking-widest">Essay</span>
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M17 8l4 4-4 4M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </article>

      <!-- Card 3 -->
      <article class="card fade-up bg-white rounded-sm shadow-sm border border-amber-100 p-7 relative overflow-hidden flex flex-col">
        <svg class="hop-icon text-amber-400" viewBox="0 0 100 100" fill="currentColor">
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.4" transform="rotate(-30 50 50)"/>
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.3" transform="rotate(30 50 50)"/>
          <ellipse cx="50" cy="50" rx="10" ry="45" opacity="0.5"/>
        </svg>
        <div class="flex items-center justify-between mb-5">
          <span class="badge-published text-xs font-body font-bold tracking-wider uppercase px-2.5 py-1 rounded-full">Published</span>
          <time class="text-xs text-amber-700 font-light font-body">Feb 27, 2025</time>
        </div>
        <h2 class="font-display text-xl font-semibold text-bark-900 leading-snug mb-3">
          <a href="#" class="card-link hover:text-amber-700 transition-colors">Cold IPA: A New American Classic</a>
        </h2>
        <p class="text-sm text-bark-700 font-body font-light leading-relaxed flex-1">
          Fermented cold with lager yeast but hopped like a West Coast IPA — this emerging style is dividing purists and delighting drinkers. Here's what makes it work.
        </p>
        <div class="mt-6 pt-5 border-t border-amber-100 flex items-center justify-between">
          <span class="text-xs text-amber-600 font-body uppercase tracking-widest">Review</span>
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M17 8l4 4-4 4M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </article>

      <!-- Card 4 -->
      <article class="card fade-up bg-white rounded-sm shadow-sm border border-amber-100 p-7 relative overflow-hidden flex flex-col">
        <svg class="hop-icon text-amber-400" viewBox="0 0 100 100" fill="currentColor">
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.4" transform="rotate(-30 50 50)"/>
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.3" transform="rotate(30 50 50)"/>
          <ellipse cx="50" cy="50" rx="10" ry="45" opacity="0.5"/>
        </svg>
        <div class="flex items-center justify-between mb-5">
          <span class="badge-published text-xs font-body font-bold tracking-wider uppercase px-2.5 py-1 rounded-full">Published</span>
          <time class="text-xs text-amber-700 font-light font-body">Feb 14, 2025</time>
        </div>
        <h2 class="font-display text-xl font-semibold text-bark-900 leading-snug mb-3">
          <a href="#" class="card-link hover:text-amber-700 transition-colors">On Water Chemistry &amp; Mash pH</a>
        </h2>
        <p class="text-sm text-bark-700 font-body font-light leading-relaxed flex-1">
          The invisible ingredient that shapes every aspect of your beer. A thoughtful homebrewer's guide to understanding water profiles without the chemistry degree.
        </p>
        <div class="mt-6 pt-5 border-t border-amber-100 flex items-center justify-between">
          <span class="text-xs text-amber-600 font-body uppercase tracking-widest">Technique</span>
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M17 8l4 4-4 4M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </article>

      <!-- Card 5 -->
      <article class="card fade-up bg-white rounded-sm shadow-sm border border-amber-100 p-7 relative overflow-hidden flex flex-col">
        <svg class="hop-icon text-amber-400" viewBox="0 0 100 100" fill="currentColor">
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.4" transform="rotate(-30 50 50)"/>
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.3" transform="rotate(30 50 50)"/>
          <ellipse cx="50" cy="50" rx="10" ry="45" opacity="0.5"/>
        </svg>
        <div class="flex items-center justify-between mb-5">
          <span class="badge-draft text-xs font-body font-bold tracking-wider uppercase px-2.5 py-1 rounded-full">Draft</span>
          <time class="text-xs text-amber-700 font-light font-body">Jan 30, 2025</time>
        </div>
        <h2 class="font-display text-xl font-semibold text-bark-900 leading-snug mb-3">
          <a href="#" class="card-link hover:text-amber-700 transition-colors">Imperial Stouts &amp; the Patience They Demand</a>
        </h2>
        <p class="text-sm text-bark-700 font-body font-light leading-relaxed flex-1">
          Barrel-aged, rich, and complex — the imperial stout rewards those willing to cellar a bottle and wait. A meditation on time, oak, and deeply dark malts.
        </p>
        <div class="mt-6 pt-5 border-t border-amber-100 flex items-center justify-between">
          <span class="text-xs text-amber-600 font-body uppercase tracking-widest">Tasting</span>
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M17 8l4 4-4 4M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </article>

      <!-- Card 6 -->
      <article class="card fade-up bg-white rounded-sm shadow-sm border border-amber-100 p-7 relative overflow-hidden flex flex-col">
        <svg class="hop-icon text-amber-400" viewBox="0 0 100 100" fill="currentColor">
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.4" transform="rotate(-30 50 50)"/>
          <ellipse cx="50" cy="50" rx="30" ry="45" opacity="0.3" transform="rotate(30 50 50)"/>
          <ellipse cx="50" cy="50" rx="10" ry="45" opacity="0.5"/>
        </svg>
        <div class="flex items-center justify-between mb-5">
          <span class="badge-published text-xs font-body font-bold tracking-wider uppercase px-2.5 py-1 rounded-full">Published</span>
          <time class="text-xs text-amber-700 font-light font-body">Jan 18, 2025</time>
        </div>
        <h2 class="font-display text-xl font-semibold text-bark-900 leading-snug mb-3">
          <a href="#" class="card-link hover:text-amber-700 transition-colors">Saison: The Farmhouse Philosophy</a>
        </h2>
        <p class="text-sm text-bark-700 font-body font-light leading-relaxed flex-1">
          Born out of necessity in Belgian farmhouses, the saison is perhaps the most expressive and free-spirited style in all of brewing. And that's exactly why we love it.
        </p>
        <div class="mt-6 pt-5 border-t border-amber-100 flex items-center justify-between">
          <span class="text-xs text-amber-600 font-body uppercase tracking-widest">History</span>
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M17 8l4 4-4 4M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </article>
    </div>

@endSection