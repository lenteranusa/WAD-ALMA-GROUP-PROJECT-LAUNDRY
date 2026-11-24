@extends('layouts.app')
@section('title', 'Edit Service')

@section('content')
<div style="max-width:420px; margin:0 auto;">
    <h1>Edit Service</h1>
    <div class="card">
        <form action="{{ route('services.update', $service) }}" method="POST" class="form-stack">
            @csrf
            @method('PUT')

            <label>Package Type</label>
            <select name="package_type" required>
                @foreach (['Kg', 'Piece', 'Express'] as $type)
                    <option value="{{ $type }}" @selected($service->package_type == $type)>{{ $type }}</option>
                @endforeach
            </select>

            <label>Price (Rp)</label>
            <input type="number" name="price" min="0" value="{{ (int) $service->price }}" required>

            <label>Time Estimate</label>
            <input type="text" name="time_estimate" value="{{ $service->time_estimate }}" required>

            <button type="submit">Update Service</button>
            @if ($errors->any())
                <p style="color:#A0333F; margin:0;">{{ $errors->first() }}</p>
            @endif
        </form>
        <p style="text-align:center; margin:14px 0 0;"><a class="muted-link" href="{{ route('services.index') }}">Cancel</a></p>
    </div>
</div>
@endsection
