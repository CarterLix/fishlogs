<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Fishlogs')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">


</head>

<body class="bg-dark text-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">Fishlogs</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fishlogs.index') }}">Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fishlogs.create') }}">Add</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<footer class="mt-5 pt-4 pb-4 border-top" style="border-color: rgba(255,255,255,.08) !important;">
    <div class="container text-center">
        @php
            $q = collect(config('quotes'))->random();
        @endphp

        <p class="mb-2 text-secondary" style="font-size: .95rem;">
            "{{ $q['text'] }}"
        </p>

        <small class="text-secondary" style="opacity:.6;">
            -"{{ $q['author'] }}"
        </small>

        <div class="mt-3 text-secondary" style="font-size:.85rem; opacity:.55;">
            © {{ date('Y') }} FishLogs
        </div>

    </div>
</footer>


{{-- Bootstrap JS bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
