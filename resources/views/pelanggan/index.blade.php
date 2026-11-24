@extends('layouts.app')
@section('title', 'Customer Data Module')

@section('content')
<h1>Customer Data Module</h1>

@if ($errors->any())
    <div class="alert alert-error">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="card">
    <h2>Add customer</h2>
    <form method="POST" action="{{ route('pelanggan.store') }}" class="add-form">
        @csrf
        <input type="text" name="nama" placeholder="Name" value="{{ old('nama') }}" required>
        <input type="text" name="telepon" placeholder="Phone number" value="{{ old('telepon') }}" required>
        <input type="text" name="alamat" placeholder="Address" value="{{ old('alamat') }}">
        <input type="text" name="catatan" placeholder="Special handling notes" value="{{ old('catatan') }}">
        <button type="submit">Add</button>
    </form>
</div>

<div class="card">
    {{-- Forms sit outside the table (valid HTML); inputs link to them with form="..." --}}
    @foreach ($pelanggan as $i => $p)
        <form id="update-{{ $i }}" method="POST" action="{{ route('pelanggan.update', $i) }}">
            @csrf
            @method('PUT')
        </form>
        @if (auth()->user()->hasRole('admin'))
        <form id="delete-{{ $i }}" method="POST" action="{{ route('pelanggan.destroy', $i) }}">
            @csrf
            @method('DELETE')
        </form>
        @endif
    @endforeach

    <table>
        <tr>
            <th>No</th><th>Name</th><th>Phone</th><th>Address</th><th>Notes</th><th>Update</th>
            @if (auth()->user()->hasRole('admin')) <th>Delete</th> @endif
        </tr>
        @forelse ($pelanggan as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td><input type="text" form="update-{{ $i }}" name="nama"    value="{{ $p['nama'] }}"></td>
            <td><input type="text" form="update-{{ $i }}" name="telepon" value="{{ $p['telepon'] }}"></td>
            <td><input type="text" form="update-{{ $i }}" name="alamat"  value="{{ $p['alamat'] }}"></td>
            <td><input type="text" form="update-{{ $i }}" name="catatan" value="{{ $p['catatan'] }}"></td>
            <td><button type="submit" form="update-{{ $i }}">Update</button></td>
            @if (auth()->user()->hasRole('admin'))
            <td><button type="submit" form="delete-{{ $i }}" class="btn-danger"
                        onclick="return confirm('Delete this customer?')">Delete</button></td>
            @endif
        </tr>
        @empty
        <tr><td colspan="7">No customers yet.</td></tr>
        @endforelse
    </table>
</div>
@endsection
