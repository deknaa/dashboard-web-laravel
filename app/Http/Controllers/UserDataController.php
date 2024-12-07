<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'status' => 'required|in:active,not_active',
            'role' => 'required|in:admin,user',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', "User dengan nama {$request->nama} berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'nim' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,not_active',
            'role' => 'nullable|in:admin,user',
            'password' => 'nullable|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', "User dengan nama {$request->nama} berhasil diedit.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
