<?php

namespace App\Http\Controllers;

use App\Models\RuangKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuangKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangkelas = RuangKelas::all();
        return view('ruangkelas.admin.index', compact('ruangkelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangkelas.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'lokasi' => 'required|string',
            'harga_sewa' => 'required|numeric',
            'status' => 'required|in:active,not_active,disewa',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('ruangkelas', 'public');
            $validated['gambar'] = $imagePath;
        }

        RuangKelas::create($validated);

        return redirect()->route('ruangkelas.index')->with('success', "Ruang kelas dengan nama {$validated['nama_ruangan']} berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data ruang kelas berdasarkan ID
        $ruangkelas = RuangKelas::findOrFail($id);
        return view('ruangkelas.admin.show', compact('ruangkelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data ruang kelas berdasarkan ID
        $ruangkelas = RuangKelas::findOrFail($id);

        return view('ruangkelas.admin.edit', compact('ruangkelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'lokasi' => 'nullable|string',
            'harga_sewa' => 'nullable|numeric',
            'status' => 'nullable|in:active,not_active,disewa',
        ]);

        // Cari data berdasarkan ID
        $ruangkelas = RuangKelas::findOrFail($id);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($ruangkelas->gambar) {
                Storage::disk('public')->delete($ruangkelas->gambar);
            }

            // Simpan gambar baru
            $imagePath = $request->file('gambar')->store('ruangkelas', 'public');
            $validated['gambar'] = $imagePath;
        }


        $ruangkelas->update($validated);

        return redirect()->route('ruangkelas.index')->with('success', "Ruang kelas dengan nama {$ruangkelas->nama_ruangan} berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $ruangkelas = RuangKelas::findOrFail($id);
        $ruangkelas->delete();
        return redirect()->route('ruangkelas.index')->with('success', "Ruang kelas dengan nama {$ruangkelas->nama_ruangan} berhasil dihapus.");
    }
}
