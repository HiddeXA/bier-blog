<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@400;600&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>
        :root{
            --bd-background:#fef9f2;
            --bd-surface:#fef9f2;
            --bd-surface-container:#f2ede6;
            --bd-primary:#9d440c;
            --bd-secondary:#77574d;
            --bd-tertiary:#785900;
            --bd-on-surface:#1d1c18;
            --bd-card-radius:12px;
            --bd-spacing:1rem;
        }
        *{box-sizing:border-box}
        html,body{height:100%;margin:0}
        body{background:var(--bd-background);color:var(--bd-on-surface);font-family:'Work Sans',system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial;line-height:1.6}
        .container{max-width:980px;margin:0 auto;padding:2rem}
        .header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem}
        .site-title{font-family:'Newsreader',Georgia,serif;font-size:1.5rem;color:var(--bd-primary);text-decoration:none}
        .card{background:var(--bd-surface-container);border-radius:var(--bd-card-radius);padding:1.25rem}
        .post-list li{margin-bottom:1.25rem}
        .post-link{color:var(--bd-on-surface);font-family:'Newsreader',serif;font-size:1.125rem;text-decoration:none}
        .post-desc{color:#6b6b66;margin-top:0.25rem}
        .article{background:#ffffff;padding:1.5rem;border-radius:10px}
        a.cta{background:linear-gradient(180deg,var(--bd-primary),#e77b43);color:#fff;padding:0.5rem 0.9rem;border-radius:8px;text-decoration:none;font-weight:600}
        @media (prefers-color-scheme:dark){
            body{background:#1d1c18;color:#fef9f2}
            .card{background:#2b2621}
        }
    </style>
</head>
<body>
    <header class="container header">
        <a href="{{ url('/') }}" class="site-title">{{ config('app.name') }}</a>
        <nav><a href="{{ route('posts.index') }}" class="cta">Beer Discovery</a></nav>
    </header>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>
