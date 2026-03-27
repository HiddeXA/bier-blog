<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of published posts.
     */
    public function index()
    {
        $posts = Post::where('published', true)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display a single post.
     */
    public function show(Post $post)
    {
        if (! $post->published && app()->environment('production')) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }
}
