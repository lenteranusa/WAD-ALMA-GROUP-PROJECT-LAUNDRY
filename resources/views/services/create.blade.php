@extends('layouts.app')
@section('title', 'Add Service')

@section('content')
<div style="max-width:420px; margin:0 auto;">
    <h1>Add Service</h1>
    <div class="card">
        <form action="{{ route('services.store') }}" method="POST" class="form-stack">
            @csrf
            <label for="package_type">Package Type</label>
            <select name="package_type" id="package_type" onchange="changeDetails()" required>
                <option value="Kg">Kg</option>
                <option value="Piece">Piece</option>
                <option value="Express">Express</option>
            </select>

            <label for="price">Price List (Rp)</label>
            <input type="number" name="price" id="price" value="7000" min="1" readonly required>

            <label for="time_estimate">Time Estimate</label>
            <input type="text" name="time_estimate" id="time_estimate" value="2 days" readonly required>

            <button type="submit">Save</button>
            @if ($errors->any())
                <p style="color:#A0333F; margin:0;">{{ $errors->first() }}</p>
            @endif
        </form>
        <p style="text-align:center; margin:14px 0 0;"><a class="muted-link" href="{{ route('services.index') }}">View Service Table</a></p>
    </div>
</div>
<script>
function changeDetails() {
    var t = document.getElementById("package_type").value;
    var price = document.getElementById("price");
    var time = document.getElementById("time_estimate");
    if (t === "Kg") { price.value = 7000; time.value = "2 days"; }
    else if (t === "Piece") { price.value = 10000; time.value = "1 day"; }
    else if (t === "Express") { price.value = 15000; time.value = "7 hours"; }
}
</script>
@endsection
