<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DonasiKu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green: #16a34a;
            --green-light: #22c55e;
            --green-dark: #15803d;
            --navy: #1e3a5f;
            --gray: #6b7280;
            --gray-light: #f9fafb;
            --white: #ffffff;
            --shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1f2937;
            background: var(--white);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main { flex: 1; }
        a { text-decoration: none; color: inherit; }
        .btn-primary {
            background: var(--green);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: var(--green-dark); }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 24px; }
    </style>
</head>
<body>
    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
