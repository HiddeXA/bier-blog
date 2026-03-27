<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// ── Reviews ──────────────────────────────────────────────────────────────
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/reviews/{review:slug}', [ReviewController::class, 'show'])->name('reviews.show');
 
 
// ── Breweries ────────────────────────────────────────────────────────────
Route::get('/breweries', [BreweryController::class, 'index'])->name('breweries');
Route::get('/breweries/{brewery:slug}', [BreweryController::class, 'show'])->name('breweries.show');
 
 
// ── Static Pages ─────────────────────────────────────────────────────────
Route::get('/home',   [PageController::class, 'home'])->name('home');
Route::get('/about',   [PageController::class, 'about'])->name('about');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
 
 
// ── Newsletter ───────────────────────────────────────────────────────────
Route::get('/newsletter',  [NewsletterController::class, 'index'])->name('newsletter');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
 
 
// ── RSS Feed ─────────────────────────────────────────────────────────────
Route::get('/rss', [PostController::class, 'rss'])->name('rss');