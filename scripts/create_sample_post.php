<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$p = Post::create([
    'title' => 'Sample Beer Post',
    'description' => 'A test post created by the setup script.',
    'content' => '<p>Hello from sample post</p>',
    'published' => true,
]);

echo $p->id . PHP_EOL;
