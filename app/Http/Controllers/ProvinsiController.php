<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
    public function index(Request $request)
    {
        $query = Provinsi::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('kode_prov', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama_provinsi', 'LIKE', '%' . $search . '%');
        }
    
        $provinces = $query->orderBy('kode_prov', 'asc')->paginate(15)->onEachSide(2);
    
        return view('adminpus.provinsi.index', compact('provinces'));
    }
    
    public function create()
    {
        return view('adminpus.provinsi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prov' => 'required|string|unique:provinsis,kode_prov',
            'nama_provinsi' => 'required|string|max:255|unique:provinsis,nama_provinsi',
        ]);

        Provinsi::create($validated);

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi berhasil ditambahkan!');
    }

    public function edit($kode_prov)
    {
        $provinsi = Provinsi::findOrFail($kode_prov);
        return view('adminpus.provinsi.edit', compact('provinsi'));
    }

    public function update(Request $request, $kode_prov)
    {
        $provinsi = Provinsi::findOrFail($kode_prov);

        $validated = $request->validate([
            'nama_provinsi' => 'required|string|max:255|unique:provinsis,nama_provinsi,' . $kode_prov . ',kode_prov',
        ]);

        $provinsi->update($validated);

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi berhasil diperbarui!');
    }

    public function destroy($kode_prov)
    {
        $provinsi = Provinsi::findOrFail($kode_prov);
        $provinsi->delete();

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi berhasil dihapus!');
    }
}
