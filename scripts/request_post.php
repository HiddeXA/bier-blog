<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/posts/2', 'GET');
$response = $kernel->handle($request);
echo $response->getStatusCode() . PHP_EOL;
$content = $response->getContent();
echo substr(strip_tags($content), 0, 400) . PHP_EOL;
$kernel->terminate($request, $response);
