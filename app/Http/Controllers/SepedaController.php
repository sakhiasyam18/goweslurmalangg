<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sepeda;
use Illuminate\Http\Request;

class SepedaController extends Controller
{
    /**
     * Menampilkan semua data sepeda.
     */
    public function index()
    {
        $sepeda = Sepeda::all();
        return view('admin.data-sepeda', compact('sepeda'));
    }

    /**
     * Menampilkan form tambah sepeda.
     */
    public function create()
    {
        return view('sepeda.tambah-sepeda');
    }

    /**
     * Menyimpan data sepeda baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi semua input termasuk gambar
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

        // Simpan file gambar ke folder public/images
        $file = $request->file('Gambar_Sepeda');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $namaFile, 'public');

        // Simpan data ke database
        Sepeda::create([
            'ID_Sepeda' => $request->ID_Sepeda,
            'Nama_Sepeda' => $request->Nama_Sepeda,
            'Kategori_Sepeda' => $request->Kategori_Sepeda,
            'Status_Sepeda' => $request->Status_Sepeda,
            'Gambar_Sepeda' => $path,
        ]);

        return redirect()->route('admin.sepeda.index')->with('success', 'Data sepeda berhasil ditambahkan!');
    }


    /**
     * Menampilkan form edit data sepeda.
     */
    public function edit($id)
    {
        $sepeda = Sepeda::findOrFail($id);
        return view('sepeda.edit-sepeda', compact('sepeda'));
    }

    /**
     * Memperbarui data sepeda yang sudah ada.
     */
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

    /**
     * Menghapus data sepeda.
     */
    // public function destroy($id)
    // {
    //     $sepeda = Sepeda::findOrFail($id);
    //     $sepeda->delete();

    //     return redirect()->route('sepeda.index')
    //         ->with('success', 'Data sepeda berhasil dihapus!');
    // }
}
