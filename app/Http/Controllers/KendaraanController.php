<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('Kendaraan.admin.index', compact('kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Kendaraan.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|in:mobil,motor',
            'gambar' => 'nullable|image|max:3072',
            'no_polisi' => 'required|string|unique:kendaraan,no_polisi',
            'tahun_kendaraan' => 'required|string',
            'harga_sewa' => 'required|numeric',
            'status' => 'required|in:active,not_active,disewa',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('kendaraan', 'public');
            $validated['gambar'] = $imagePath;
        }

        Kendaraan::create($validated);

        return redirect()->route('kendaraan.index')->with('success', "Kendaraan dengan nama {$validated["nama_kendaraan"]} berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data ruang kelas berdasarkan ID
        $kendaraan = Kendaraan::findOrFail($id);
        return view('kendaraan.admin.show', compact('kendaraan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data ruang kelas berdasarkan ID
        $kendaraan = Kendaraan::findOrFail($id);

        return view('kendaraan.admin.edit', compact('kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kendaraan' => 'nullable|string|max:255',
            'jenis_kendaraan' => 'nullable|in:mobil,motor',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'no_polisi' => 'nullable|string',
            'tahun_kendaraan' => 'nullable|numeric',
            'harga_sewa' => 'nullable|numeric',
            'status' => 'nullable|in:active,not_active,disewa',
        ]);

        // Cari data berdasarkan ID
        $kendaraan = Kendaraan::findOrFail($id);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kendaraan->gambar)
             {
                Storage::disk('public')->delete($kendaraan->gambar);
            }

            // Simpan gambar baru
            $imagePath = $request->file('gambar')->store('kendaraan', 'public');
            $validated['gambar'] = $imagePath;
        }


        $kendaraan->update($validated);

        return redirect()->route('kendaraan.index')->with('success', "Kendaraan dengan nama {$validated["nama_kendaraan"]} berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', "Kendaraan dengan nama {$kendaraan->nama_kendaraan} berhasil dihapus.");
    }
}
