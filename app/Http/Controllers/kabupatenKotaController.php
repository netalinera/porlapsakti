<?php

namespace App\Http\Controllers;


use App\Models\KabKota;
use App\Models\provinsi;
use Illuminate\Http\Request;

class KabupatenKotaController extends Controller
{
    public function index(Request $request)
    {
        $query = KabKota::with('provinsi');
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_kab_kota', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('provinsi', function ($q) use ($search) {
                      $q->where('nama_provinsi', 'LIKE', '%' . $search . '%');
                  });
        }
    
        $kab_kotas = $query->orderBy('id_prov', 'asc')
                           ->orderBy('id', 'asc')
                           ->paginate(15)
                           ->onEachSide(2);
    
        return view('adminpus.kab_kota.index', compact('kab_kotas'));
    }
    

    public function create()
    {
        $provinces = provinsi::orderBy('id', 'asc')->get();
        return view('adminpus.kab_kota.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric|unique:kab_kotas,id',
            'id_prov' => 'required|exists:provinsis,id',
            'nama_kab_kota' => 'required|string|max:255|unique:kab_kotas,nama_kab_kota'
        ], [
            'id.required' => 'ID kabupaten/kota wajib diisi',
            'id.numeric' => 'ID harus berupa angka',
            'id.unique' => 'ID sudah digunakan',
            'id_prov.required' => 'Provinsi wajib dipilih',
            'id_prov.exists' => 'Provinsi tidak valid',
            'nama_kab_kota.required' => 'Nama kabupaten/kota wajib diisi',
            'nama_kab_kota.unique' => 'Nama kabupaten/kota sudah ada'
        ]);

        KabKota::create($validated);

        return redirect()->route('kab_kota.index')
            ->with('success', 'Kabupaten/Kota berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kab_kota = KabKota::findOrFail($id);
        $provinces = provinsi::orderBy('id', 'asc')->get();
        return view('adminpus.kab_kota.edit', compact('kab_kota', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        $kab_kota = KabKota::findOrFail($id);

        $validated = $request->validate([
            'id_prov' => 'required|exists:provinsis,id',
            'nama_kab_kota' => 'required|string|max:255|unique:kab_kotas,nama_kab_kota,' . $id
        ], [
            'id_prov.required' => 'Provinsi wajib dipilih',
            'id_prov.exists' => 'Provinsi tidak valid',
            'nama_kab_kota.required' => 'Nama kabupaten/kota wajib diisi',
            'nama_kab_kota.unique' => 'Nama kabupaten/kota sudah ada'
        ]);

        $kab_kota->update($validated);

        return redirect()->route('kab_kota.index')
            ->with('success', 'Kabupaten/Kota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kab_kota = KabKota::findOrFail($id);
        $kab_kota->delete();

        return redirect()->route('kab_kota.index')
            ->with('success', 'Kabupaten/Kota berhasil dihapus!');
    }

    public function getKabKotaByProvinsi($id_prov)
    {
        $kabKotas = KabKota::where('id_prov', $id_prov)->orderBy('nama_kab_kota', 'asc')->get();
        return response()->json($kabKotas);
    }
}
