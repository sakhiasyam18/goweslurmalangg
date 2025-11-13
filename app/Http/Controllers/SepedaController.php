<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sepeda;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;

class SepedaController extends Controller
{
    public function index()
    {
          $now = Carbon::now();

    // Cari semua pemesanan yang sudah lewat dari waktu selesai
    Pemesanan::where('Tanggal_Selesai', '<', $now)
        ->whereHas('sepeda', function ($query) {
            $query->where('Status_Sepeda', 'Dipinjam');
        })
        ->each(function ($pemesanan) {
            // Update status sepeda ke "Tersedia"
            $pemesanan->sepeda->update(['Status_Sepeda' => 'Tersedia']);
        });

    // Setelah update, ambil data sepeda terbaru
    $sepeda = Sepeda::all();
    return view('admin.data-sepeda', compact('sepeda'));
    }

    public function create()
    {
        return view('sepeda.tambah-sepeda');
    }

    public function store(Request $request)
    {

        $request->validate([
            'ID_Sepeda' => 'required|unique:sepeda,ID_Sepeda',
            'Nama_Sepeda' => 'required|string|max:255',
            'Kategori_Sepeda' => 'required',
            'Status_Sepeda' => 'required',
            'Gambar_Sepeda' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'ID_Sepeda.required' => 'ID sepeda wajib diisi.',
            'ID_Sepeda.unique' => 'ID sepeda sudah terdaftar.',
            'Nama_Sepeda.required' => 'Nama sepeda wajib diisi.',
            'Kategori_Sepeda.required' => 'Kategori sepeda wajib diisi.',
            'Status_Sepeda.required' => 'Status sepeda wajib diisi.',
            'Gambar_Sepeda.required' => 'Gambar sepeda wajib diupload.',
        ]);

        $file = $request->file('Gambar_Sepeda');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('sepeda', $namaFile, 'public');

        Sepeda::create([
            'ID_Sepeda' => $request->ID_Sepeda,
            'Nama_Sepeda' => $request->Nama_Sepeda,
            'Kategori_Sepeda' => $request->Kategori_Sepeda,
            'Status_Sepeda' => $request->Status_Sepeda,
            'Gambar_Sepeda' => $path,
        ]);

        return redirect()->route('admin.sepeda.index')->with('success', 'Data sepeda berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $sepeda = Sepeda::findOrFail($id);
        return view('sepeda.edit-sepeda', compact('sepeda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Sepeda' => 'required',
            'Kategori_Sepeda' => 'required',
            'Status_Sepeda' => 'required',
        ], [
            'Nama_Sepeda.required' => 'Nama sepeda wajib diisi.',
            'Kategori_Sepeda.required' => 'Kategori sepeda wajib diisi.',
            'Status_Sepeda.required' => 'Status sepeda wajib diisi.',
        ]);

        $sepeda = Sepeda::findOrFail($id);
        $sepeda->update($request->only([
            'Nama_Sepeda',
            'Kategori_Sepeda',
            'Status_Sepeda',
            'Gambar_Sepeda'
        ]));

        return redirect()->route('admin.sepeda.index')
            ->with('success', 'Data sepeda berhasil diperbarui!');
    }

    

}
