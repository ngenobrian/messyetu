<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - MessYetu</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <div class="nav-brand-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 11h16a1 1 0 0 1 1 1c0 5.5-4.5 8-9 8s-9-2.5-9-8a1 1 0 0 1 1-1z" />
                    <path d="M7 4c0 1.5-1 2-1 3" />
                    <path d="M12 3c0 2-1 2.5-1 4" />
                    <path d="M17 4c0 1.5-1 2-1 3" />
                </svg>
            </div>
            <span>MessYetu</span>
        </div>
        <div class="nav-user">
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-phone">{{ auth()->user()->phone_number }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-signout">Sign out</button>
            </form>
        </div>
    </nav>

    <main class="main-content">
        <div class="welcome-card">
            <h1>Welcome, {{ auth()->user()->name }}!</h1>
            <p>You are successfully signed in with phone number {{ auth()->user()->phone_number }}. Skip the queue and order cafeteria meals right from your phone.</p>
        </div>
    </main>
</body>
</html>
