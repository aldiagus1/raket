<?php

namespace App\Http\Controllers;

use App\Models\Raket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index() {
        $rakets = Raket::all();
        return view('admin.index', compact('rakets'));
    }

    public function create() { return view('admin.create'); }

    public function store(Request $request) {
        $request->validate([
            'nama_raket' => 'required', 'brand' => 'required', 'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'power' => 'required|numeric|min:1|max:100', 'control' => 'required|numeric|min:1|max:100',
            'speed' => 'required|numeric|min:1|max:100', 'durability' => 'required|numeric|min:1|max:100',
            'flexibility' => 'required|numeric|min:1|max:100',
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('rakets', 'public');
        }

        Raket::create($data);
        return redirect()->route('admin.index')->with('success', 'Raket berhasil ditambahkan.');
    }

    public function edit(Raket $raket)
{
    return view('admin.edit', compact('raket'));
}

public function update(Request $request, Raket $raket)
{
    $request->validate([
        'nama_raket' => 'required',
        'brand' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        'power' => 'required|numeric|min:1|max:100',
        'control' => 'required|numeric|min:1|max:100',
        'speed' => 'required|numeric|min:1|max:100',
        'durability' => 'required|numeric|min:1|max:100',
        'flexibility' => 'required|numeric|min:1|max:100',
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        if ($raket->gambar) {
            Storage::disk('public')->delete($raket->gambar);
        }
        $data['gambar'] = $request->file('gambar')->store('rakets', 'public');
    }

    $raket->update($data);

    return redirect()->route('admin.index')->with('success', 'Data raket badminton berhasil diperbarui.');
}

    public function destroy(Raket $raket) {
        if ($raket->gambar) { Storage::disk('public')->delete($raket->gambar); }
        $raket->delete();
        return redirect()->route('admin.index')->with('success', 'Raket berhasil dihapus.');
    }
}
