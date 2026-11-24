@extends('layouts.app')
@section('title', 'Register User - Don N Done')

@section('content')
<div style="max-width:420px; margin:0 auto;">
    <h1>Register New User</h1>
    <div class="card">
        <p style="margin:0 0 12px; font-size:14px; color:#1c2b4a;">Only admins can create accounts. New accounts are <b>staff</b>.</p>
        <form method="POST" action="{{ route('register') }}" class="form-stack">
            @csrf
            <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" required>
            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password (min 8 characters)" required>
            <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            <button type="submit">Create account</button>
            @if ($errors->any())
                <p style="color:#A0333F; margin:0;">{{ $errors->first() }}</p>
            @endif
        </form>
    </div>
</div>
@endsection
