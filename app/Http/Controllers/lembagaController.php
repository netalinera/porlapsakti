<?php

namespace App\Http\Controllers;

use App\Models\KabKota;
use App\Models\KelDesa;
use Illuminate\Http\Request;
use App\Models\Lembaga;
use App\Models\Provinsi;
use App\Models\kecamatan;

class lembagaController extends Controller
{
    // Menampilkan data lembaga
    public function index(Request $request)
    {
        $query = Lembaga::with(['provinsi', 'kab_kota', 'kecamatan', 'kel_desa']);
    
        // Filter pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama_lembaga', 'LIKE', '%' . $search . '%')
                  ->orWhere('nama_perpus', 'LIKE', '%' . $search . '%')
                  ->orWhere('NPP', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('provinsi', function ($q) use ($search) {
                      $q->where('nama_provinsi', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('kab_kota', function ($q) use ($search) {
                      $q->where('nama_kab_kota', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('kecamatan', function ($q) use ($search) {
                      $q->where('nama_kecamatan', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('kel_desa', function ($q) use ($search) {
                      $q->where('nama_kel_desa', 'LIKE', '%' . $search . '%');
                  });
        }
    
        // Paginasi dan sorting
        $lembagas = $query->orderBy('kode_prov', 'asc')
                          ->orderBy('kode_kab_kota', 'asc')
                          ->paginate(15)
                          ->onEachSide(2);
    
        return view('adminpus.lembaga.index', compact('lembagas'));
    }    

    // Menampilkan halaman tambah lembaga
    public function create()
    {
        $provinces = Provinsi::all();
        $kabupatenKotas = KabKota::all();
        $kecamatans = kecamatan::all();
        
        return view('adminpus.lembaga.create', compact('provinces', 'kabupatenKotas', 'kecamatans'));
    }

    // Menyimpan data lembaga baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'kode_kec' => 'required|exists:kecamatans,kode_kec',
            'kode_kel_desa' => 'required|exists:kel_desas,kode_kel_desa',
            'nama_lembaga' => 'required|max:300',
            'nama_perpus' => 'required|max:300',
            'NPP' => 'required|unique:lembagas,NPP',
            'alamat' => 'required',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
            'email_lembaga' => 'required|email',
            'email_perpus' => 'required|email',
        ]);

        $validated['created_by'] = auth()->user()->username;
        $validated['updated_by'] = auth()->user()->username;

        Lembaga::create($validated);

        return redirect()->route('lembaga.index')->with('success', 'Lembaga berhasil ditambahkan!');
    }

    // Menampilkan halaman edit lembaga
    public function edit($id)
    {
        $lembaga = Lembaga::findOrFail($id);
        $provinces = Provinsi::all();
        $kabupatenKotas = KabKota::where('kode_prov', $lembaga->kode_prov)->get();
        $kecamatans = kecamatan::where('kode_kab_kota', $lembaga->kode_kab_kota)->get();
        $kelurahanDesas = KelDesa::where('kode_kec', $lembaga->kode_kec)->get();

    return view('adminpus.lembaga.edit', compact('lembaga', 'provinces', 'kabupatenKotas', 'kecamatans', 'kelurahanDesas'));
    }

    // Memperbarui data lembaga
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_prov' => 'required|exists:provinsis,kode_prov',
            'kode_kab_kota' => 'required|exists:kab_kotas,kode_kab_kota',
            'kode_kec' => 'required|exists:kecamatans,kode_kec',
            'kode_kel_desa' => 'required|exists:kel_desas,kode_kel_desa',
            'nama_lembaga' => 'required|max:300',
            'nama_perpus' => 'required|max:300',
            'alamat' => 'required',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
            'email_lembaga' => 'required|email',
            'email_perpus' => 'required|email',
        ]);

        $validated['updated_by'] = auth()->user()->username;

        Lembaga::findOrFail($id)->update($validated);

        return redirect()->route('lembaga.index')->with('success', 'Lembaga berhasil diperbarui!');
    }

    // Menghapus data lembaga
    public function destroy($id)
    {
        $lembaga = Lembaga::findOrFail($id);
        $lembaga->delete();

        return redirect()->route('lembaga.index')->with('success', 'Lembaga berhasil dihapus!');
}
}
