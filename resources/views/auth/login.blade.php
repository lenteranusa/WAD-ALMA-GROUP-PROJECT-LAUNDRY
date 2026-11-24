<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Don N Done</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="page" style="max-width:400px; padding-top:60px;">
    <h1>Don N Done Login</h1>
    <div class="card">
        <form method="POST" action="{{ route('login') }}" class="form-stack">
            @csrf
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log in</button>
            @if ($errors->any())
                <p style="color:#A0333F; margin:0;">{{ $errors->first() }}</p>
            @endif
        </form>
    </div>
</div>
</body>
</html>
