@extends('layouts.app')
@section('title', 'Service & Rate Module')

@section('content')
<h1>Service &amp; Rate Module</h1>

<div class="card">
    @if (auth()->user()->hasRole('admin'))
        <p style="margin:0 0 14px;"><a href="{{ route('services.create') }}" class="btn">+ Add Service</a></p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th><th>Serial Number</th><th>Package Type</th><th>Price (Rp)</th><th>Time Estimate</th>
                @if (auth()->user()->hasRole('admin')) <th>Action</th> @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $index => $service)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $service->serial_number }}</td>
                <td>{{ $service->package_type }}</td>
                <td>{{ number_format($service->price, 0, ',', '.') }}</td>
                <td>{{ $service->time_estimate }}</td>
                @if (auth()->user()->hasRole('admin'))
                <td>
                    <a href="{{ route('services.edit', $service) }}" class="btn">Edit</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Delete this service?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr><td colspan="6">No service data available.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
