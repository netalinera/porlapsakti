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
    
        $kecamatans = $query->orderBy('kode_prov', 'asc')
                            ->orderBy('kode_kab_kota', 'asc')
                            ->orderBy('kode_kec', 'asc')
                            ->paginate(15)
                            ->onEachSide(2);
    
        return view('adminpus.kecamatan.index', compact('kecamatans'));
    }
    
    public function create()
    {
        $provinces = Provinsi::orderBy('kode_prov', 'asc')->get();
        return view('adminpus.kecamatan.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kec' => 'required|string|unique:kecamatans,kode_kec',
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        // Validasi tambahan: Pastikan nama_kecamatan unik dalam kabupaten yang sama
        $existingName = Kecamatan::where('kode_kab_kota', $request->kode_kab_kota)
                                ->where('nama_kecamatan', $request->nama_kecamatan)
                                ->exists();

        if ($existingName) {
            return redirect()->back()->withErrors(['nama_kecamatan' => 'Nama kecamatan sudah digunakan dalam kabupaten ini.']);
        }

        Kecamatan::create($validated);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    public function edit($kode_kec)
    {
        $kecamatan = Kecamatan::with(['kabKota', 'provinsi'])->findOrFail($kode_kec);
        $provinces = Provinsi::orderBy('kode_prov', 'asc')->get();
        $kabKotas = KabKota::where('kode_prov', $kecamatan->provinsi->kode_prov)->orderBy('nama_kab_kota', 'asc')->get();

        return view('adminpus.kecamatan.edit', compact('kecamatan', 'provinces', 'kabKotas'));
    }

    public function update(Request $request, $kode_kec)
    {
        $kecamatan = Kecamatan::findOrFail($kode_kec);

        $validated = $request->validate([
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        // Validasi tambahan
        $existingName = Kecamatan::where('kode_kab_kota', $request->kode_kab_kota)
                                 ->where('nama_kecamatan', $request->nama_kecamatan)
                                 ->where('kode_kec', '!=', $kode_kec)
                                 ->exists();

        if ($existingName) {
            return redirect()->back()->withErrors(['nama_kecamatan' => 'Nama kecamatan sudah digunakan dalam kabupaten ini.']);
        }

        $kecamatan->update($validated);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui!');
    }

    public function destroy($kode_kec)
    {
        $kecamatan = Kecamatan::findOrFail($kode_kec);
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil dihapus!');
    }

    public function getKecamatanByKabupaten($kode_kab_kota)
    {
        $kecamatan = Kecamatan::where('kode_kab_kota', $kode_kab_kota)->orderBy('nama_kecamatan', 'asc')->get();
        return response()->json($kecamatan);
    }
}
