@extends('layouts.app')
@section('title', 'Cleaning Material Module')

@section('content')
<h1>Cleaning Material Module</h1>

@if ($errors->any())
    <div class="alert alert-error">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

@if (auth()->user()->hasRole('admin'))
<div class="card">
    <h2>Add material</h2>
    <form method="POST" action="{{ route('materials.store') }}" class="add-form">
        @csrf
        <input type="text" name="brand" placeholder="Brand" value="{{ old('brand') }}" required>
        <select name="category" required>
            @foreach (['Fragrance', 'Detergent', 'Softener'] as $c)
                <option value="{{ $c }}" @selected(old('category') == $c)>{{ $c }}</option>
            @endforeach
        </select>
        <input type="text" name="supplier" placeholder="Supplier" value="{{ old('supplier') }}" required>
        <input type="text" name="unit" placeholder="Unit (e.g. liter, kg)" value="{{ old('unit') }}" required>
        <input type="number" name="stock" placeholder="Stock" min="0" value="{{ old('stock') }}" required>
        <select name="status" required>
            <option value="Still Available">Still Available</option>
            <option value="Need Order">Need Order</option>
        </select>
        <button type="submit">Add</button>
    </form>
</div>
@endif

<div class="card">
    @foreach ($materials as $m)
        <form id="update-{{ $m->id }}" method="POST" action="{{ route('materials.update', $m) }}">
            @csrf
            @method('PUT')
        </form>
        @if (auth()->user()->hasRole('admin'))
        <form id="delete-{{ $m->id }}" method="POST" action="{{ route('materials.destroy', $m) }}">
            @csrf
            @method('DELETE')
        </form>
        @endif
    @endforeach

    <table>
        <tr>
            <th>Brand</th><th>Category</th><th>Supplier</th><th>Unit</th><th>Stock</th><th>Status</th><th>Update</th>
            @if (auth()->user()->hasRole('admin')) <th>Delete</th> @endif
        </tr>
        @forelse ($materials as $m)
        <tr>
            <td>{{ $m->brand }}</td>
            <td>{{ $m->category }}</td>
            <td>{{ $m->supplier }}</td>
            <td>{{ $m->unit }}</td>
            <td><input type="number" form="update-{{ $m->id }}" name="stock" min="0" value="{{ $m->stock }}" style="width:80px;"></td>
            <td>
                <select form="update-{{ $m->id }}" name="status">
                    <option value="Still Available" @selected($m->status == 'Still Available')>Still Available</option>
                    <option value="Need Order" @selected($m->status == 'Need Order')>Need Order</option>
                </select>
            </td>
            <td><button type="submit" form="update-{{ $m->id }}">Update</button></td>
            @if (auth()->user()->hasRole('admin'))
            <td><button type="submit" form="delete-{{ $m->id }}" class="btn-danger"
                        onclick="return confirm('Delete this material?')">Delete</button></td>
            @endif
        </tr>
        @empty
        <tr><td colspan="8">No materials yet.</td></tr>
        @endforelse
    </table>
</div>
@endsection
