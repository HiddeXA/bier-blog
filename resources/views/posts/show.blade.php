@extends('layouts.main')

@section('title', $post->title . ' - ' . config('app.name'))

@section('content')
  <main class="flex-1 w-full">
 
        {{-- Hero / Title block --}}
        <div class="max-w-4xl mx-auto px-6 pb-10 fade-up">
 
            {{-- Back link --}}
            <a href="{{ route('posts.index') }}"
               class="inline-flex items-center gap-2 text-xs uppercase tracking-widest mb-10 transition-colors"
               style="color: #a86714; font-family: 'Lato', sans-serif;"
               onmouseover="this.style.color='#6e4015'" onmouseout="this.style.color='#a86714'">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                All Posts
            </a>
 
            {{-- Status badge + date --}}
            <div class="flex items-center gap-3 mb-6">
       
                <time class="text-xs font-light" style="color:#a86714; font-family:'Lato',sans-serif;">
                    {{ $post->created_at->format('F j, Y') }}
                    @if($post->updated_at->ne($post->created_at))
                        &mdash; Updated {{ $post->updated_at->format('F j, Y') }}
                    @endif
                </time>
            </div>
 
            {{-- Title --}}
            <h1 class="font-display text-4xl sm:text-5xl font-semibold leading-tight mb-6" style="color:#1a1208;">
                {{ $post->title }}
            </h1>
 
            {{-- Description / subtitle --}}
            @if($post->description)
                <p class="text-lg font-light leading-relaxed mb-8" style="color:#6e4015; font-family:'Lato',sans-serif;">
                    {{ $post->description }}
                </p>
            @endif
 
            {{-- Ornament divider --}}
            <div class="divider-ornament mt-8">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="#a86714">
                    <circle cx="8" cy="8" r="3"/><circle cx="2" cy="8" r="1.5"/><circle cx="14" cy="8" r="1.5"/>
                </svg>
            </div>
        </div>
 
        {{-- ─── Post content ────────────────────────────────────────────── --}}
        <div class="max-w-4xl mx-auto px-6 pb-20 fade-up-delay">
            @if($post->content)
                <article class="post-content bg-white rounded-sm border px-8 sm:px-14 py-12 shadow-sm" style="border-color:#f2d9ac;">
                    {!! $post->content !!}
                </article>
            @else
                <div class="text-center py-20" style="color:#a86714; font-family:'Lato',sans-serif;">
                    <p class="text-sm font-light tracking-wide">No content available for this post yet.</p>
                </div>
            @endif
 
            {{-- ─── Footer meta strip ───────────────────────────────────── --}}
            <div class="mt-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs font-light"
                 style="color:#a86714; font-family:'Lato',sans-serif;">
                <span>Posted on {{ $post->created_at->format('D, d M Y') }}</span>
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center gap-2 uppercase tracking-widest transition-colors"
                   style="color:#a86714;"
                   onmouseover="this.style.color='#6e4015'" onmouseout="this.style.color='#a86714'">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Back to all posts
                </a>
            </div>
        </div>
    </main>
@endsection
