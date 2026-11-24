@extends('layouts.app')
@section('title', 'Don N Done')

@section('content')
<h1>Don N Done Laundry System</h1>
<p class="intro">Pick a module to get started.</p>
<div class="card">
    <a href="{{ route('services.index') }}">Service &amp; Rate Module</a>
    <a href="{{ route('machines.index') }}">Machinery &amp; Equipment Module</a>
    <a href="{{ route('pelanggan.index') }}">Customer Data Module</a>
    <a href="{{ route('materials.index') }}">Cleaning Material Module</a>
</div>
@endsection
