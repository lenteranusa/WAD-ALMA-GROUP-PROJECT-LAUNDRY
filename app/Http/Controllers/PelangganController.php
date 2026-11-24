<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PelangganController extends Controller
{
    private const SESSION_KEY = 'pelanggan';


    private function defaultData(): array
    {
        return [
            ['nama' => 'Budi Santoso', 'telepon' => '081234567890', 'alamat' => 'Jl. Dago No. 10, Bandung',      'catatan' => 'Kemeja putih, jangan pakai pemutih'],
            ['nama' => 'Siti Aminah',  'telepon' => '081298765432', 'alamat' => 'Jl. Braga No. 5, Bandung',       'catatan' => 'Bahan sutra, cuci lembut'],
            ['nama' => 'Andi Pratama', 'telepon' => '085711223344', 'alamat' => 'Jl. Cihampelas No. 21, Bandung', 'catatan' => 'Jaket kulit, jangan diperas'],
        ];
    }

    private function rules(): array
    {
        return [
            'nama'    => ['required', 'string', 'max:100'],
            'telepon' => ['required', 'string', 'max:20'],
            'alamat'  => ['nullable', 'string', 'max:255'],
            'catatan' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function getPelanggan(Request $request): array
    {
        if (! $request->session()->has(self::SESSION_KEY)) {
            $request->session()->put(self::SESSION_KEY, $this->defaultData());
        }

        return $request->session()->get(self::SESSION_KEY);
    }

    public function index(Request $request): View
    {
        return view('pelanggan.index', [
            'pelanggan' => $this->getPelanggan($request),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());

        $pelanggan = $this->getPelanggan($request);
        $pelanggan[] = [
            'nama'    => $data['nama'],
            'telepon' => $data['telepon'],
            'alamat'  => $data['alamat'] ?? '',
            'catatan' => $data['catatan'] ?? '',
        ];
        $request->session()->put(self::SESSION_KEY, $pelanggan);

        return redirect()->route('pelanggan.index')->with('success', 'Customer added.');
    }

    public function update(Request $request, int $index): RedirectResponse
    {
        $pelanggan = $this->getPelanggan($request);
        abort_unless(isset($pelanggan[$index]), 404);

        $data = $request->validate($this->rules());

        $pelanggan[$index] = [
            'nama'    => $data['nama'],
            'telepon' => $data['telepon'],
            'alamat'  => $data['alamat'] ?? '',
            'catatan' => $data['catatan'] ?? '',
        ];
        $request->session()->put(self::SESSION_KEY, $pelanggan);

        return redirect()->route('pelanggan.index')->with('success', 'Customer updated.');
    }

    public function destroy(Request $request, int $index): RedirectResponse
    {
        $pelanggan = $this->getPelanggan($request);
        abort_unless(isset($pelanggan[$index]), 404);

        unset($pelanggan[$index]);
        $request->session()->put(self::SESSION_KEY, array_values($pelanggan));

        return redirect()->route('pelanggan.index')->with('success', 'Customer deleted.');
    }
}