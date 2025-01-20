<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\KabKota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kecamatan::with(['kabKota', 'provinsi']);
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_kecamatan', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('provinsi', function ($q) use ($search) {
                      $q->where('nama_provinsi', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('kabKota', function ($q) use ($search) {
                      $q->where('nama_kab_kota', 'LIKE', '%' . $search . '%');
                  });
        }
    
        $kecamatans = $query->orderBy('id_prov', 'asc')
                            ->orderBy('id_kab_kota', 'asc')
                            ->paginate(15)
                            ->onEachSide(2);
    
        return view('adminpus.kecamatan.index', compact('kecamatans'));
    }
    

    public function create()
    {
        // Pastikan data provinsi dimuat
        $provinces = Provinsi::orderBy('id', 'asc')->get();
        return view('adminpus.kecamatan.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|numeric|unique:kecamatans,id',
            'id_prov' => 'required|exists:provinsis,id',
            'id_kab_kota' => 'required|exists:kab_kotas,id',
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        // Validasi tambahan: Pastikan nama_kecamatan unik dalam kabupaten yang sama
        $existingName = Kecamatan::where('id_kab_kota', $request->id_kab_kota)
                                ->where('nama_kecamatan', $request->nama_kecamatan)
                                ->exists();

        if ($existingName) {
            return redirect()->back()->withErrors(['nama_kecamatan' => 'Nama kecamatan sudah digunakan dalam kabupaten ini.']);
        }

        Kecamatan::create($validated);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $kecamatan = Kecamatan::with(['kabKota', 'provinsi'])->findOrFail($id);
        $provinces = Provinsi::orderBy('id', 'asc')->get();
        $kabKotas = KabKota::where('id_prov', $kecamatan->provinsi->id)->orderBy('nama_kab_kota', 'asc')->get();

        return view('adminpus.kecamatan.edit', compact('kecamatan', 'provinces', 'kabKotas'));
    }


    public function update(Request $request, $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
    
        $validated = $request->validate([
            'id_prov' => 'required|exists:provinsis,id',
            'id_kab_kota' => 'required|exists:kab_kotas,id',
            'nama_kecamatan' => 'required|string|max:255',
        ]);
    
        // Validasi tambahan: Pastikan nama_kecamatan unik dalam kabupaten yang sama
        $existingName = Kecamatan::where('id_kab_kota', $request->id_kab_kota)
                                 ->where('nama_kecamatan', $request->nama_kecamatan)
                                 ->where('id', '!=', $id) // Abaikan data yang sedang diperbarui
                                 ->exists();
    
        if ($existingName) {
            return redirect()->back()->withErrors(['nama_kecamatan' => 'Nama kecamatan sudah digunakan dalam kabupaten ini.']);
        }
    
        $kecamatan->update($validated);
    
        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil dihapus.');
    }

    

    public function getKecamatanByKabupaten($id_kab_kota)
    {
        $kecamatan = Kecamatan::where('id_kab_kota', $id_kab_kota)->get();
        return response()->json($kecamatan);
    }


}