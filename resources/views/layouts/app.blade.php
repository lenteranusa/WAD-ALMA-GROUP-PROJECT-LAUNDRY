<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Don N Done')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header>
    <p class="brand"><a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Don N Done</a></p>
    <nav>
        <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Service &amp; Rate Module</a>
        <a href="{{ route('machines.index') }}" class="{{ request()->routeIs('machines.*') ? 'active' : '' }}">Machinery &amp; Equipment Module</a>
        <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">Customer Data Module</a>
        <a href="{{ route('materials.index') }}" class="{{ request()->routeIs('materials.*') ? 'active' : '' }}">Cleaning Material Module</a>
        @if (auth()->user()->hasRole('admin'))
            <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register User</a>
        @endif
    </nav>
    <div class="userbar">
        {{ auth()->user()->name }} ({{ auth()->user()->role }})
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</header>

<div class="page">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
