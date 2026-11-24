<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::orderByDesc('id')->get();
        return view('materials.index', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'    => 'required|string|max:100',
            'category' => 'required|in:Fragrance,Detergent,Softener',
            'supplier' => 'required|string|max:100',
            'unit'     => 'required|string|max:50',
            'stock'    => 'required|integer|min:0',
            'status'   => 'required|in:Still Available,Need Order',
        ]);

        Material::create($validated);

        return redirect()->route('materials.index')
                         ->with('success', 'Material added successfully.');
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'stock'  => 'required|integer|min:0',
            'status' => 'required|in:Still Available,Need Order',
        ]);

        $material->update($validated);

        return redirect()->route('materials.index')
                         ->with('success', 'Material updated successfully.');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')
                         ->with('success', 'Material deleted successfully.');
    }
}