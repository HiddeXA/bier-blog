<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/cron/{token}', function (string $token) {
    if ($token !== config('app.cron_token')) {
        abort(403);
    }
    Artisan::call('schedule:run');
    return response()->noContent();
});
