<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\provinsi;

class ProvinsiController extends Controller
{
    public function index(Request $request)
    {
        $query = provinsi::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama_provinsi', 'LIKE', '%' . $search . '%');
        }
    
        $provinces = $query->orderBy('id', 'asc')->paginate(15)->onEachSide(2);
    
        return view('adminpus.provinsi.index', compact('provinces'));
    }
    
    public function create()
    {
        return view('adminpus.provinsi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric|unique:provinsis,id',
            'nama_provinsi' => 'required|string|max:255|unique:provinsis,nama_provinsi',
        ]);

        provinsi::create($validated);

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $provinsi = provinsi::findOrFail($id);
        return view('adminpus.provinsi.edit', compact('provinsi'));
    }

    public function update(Request $request, $id)
    {
        $provinsi = provinsi::findOrFail($id);

        $validated = $request->validate([
            'nama_provinsi' => 'required|string|max:255|unique:provinsis,nama_provinsi,' . $id,
        ]);

        $provinsi->update($validated);

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $provinsi = provinsi::findOrFail($id);
        $provinsi->delete();

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi berhasil dihapus!');
    }
}