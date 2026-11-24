<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_type'  => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'time_estimate' => 'required|string|max:255',
        ]);

        $lastService = Service::latest('id')->first();
        $nextNumber = $lastService ? $lastService->id + 1 : 1;
        $validated['serial_number'] = 'LND-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service added successfully.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'package_type'  => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'time_estimate' => 'required|string|max:255',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
