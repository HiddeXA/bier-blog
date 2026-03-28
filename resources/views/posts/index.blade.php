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

      @forelse ($posts as $post)
      <article class="card fade-up">
        <a href="{{ route('posts.show', $post) }}" class="group bg-white rounded-sm shadow-sm border border-amber-100 p-7 relative overflow-hidden flex flex-col block">
        <div class="flex items-center justify-between mb-5">
       
          <time class="text-xs text-amber-700 font-light font-body">{{ $post->created_at->format('M j, Y') }}</time>
        </div>
        <h2 class="font-display text-xl font-semibold text-bark-900 leading-snug mb-3">
          <span class="card-link group-hover:text-amber-700 transition-colors">{{ $post->title }}</span>
        </h2>
        <p class="text-sm text-bark-700 font-body font-light leading-relaxed flex-1">
          {{ $post->description }}
        </p>
        <div class="mt-6 pt-5 border-t border-amber-100 flex items-center justify-between">
          <span class="text-xs text-amber-600 font-body uppercase tracking-widest">Article</span>
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path d="M17 8l4 4-4 4M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        </a>
      </article>
      @empty
      <div class="col-span-full text-center py-12 text-bark-700">
        <p class="text-lg font-body">No posts found.</p>
      </div>
      @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links('components.pagination') }}
    </div>

@endSection