<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | MyApp</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="hold-transition login-page">
<nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('locale.set', ['lang' => 'en']) }}" class="nav-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('locale.set', ['lang' => 'fa']) }}" class="nav-link {{ app()->getLocale() == 'fa' ? 'active' : '' }}">Farsi</a>
            </li>
        </ul>
    </div>
</nav>

<div class="login-box">
    @yield('content')
</div>

<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
