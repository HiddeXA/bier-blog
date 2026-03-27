@extends('layouts.beer')

@section('title', $post->title . ' - ' . config('app.name'))

@section('content')
    <p><a href="{{ route('posts.index') }}" style="color:var(--bd-primary);text-decoration:none">← Back to posts</a></p>

    <article class="article">
        <h1 style="font-family:'Newsreader', serif;margin-top:0">{{ $post->title }}</h1>

        @if($post->description)
            <p class="post-desc">{{ $post->description }}</p>
        @endif

        <div class="post-content">{!! $post->content !!}</div>
    </article>
@endsection
