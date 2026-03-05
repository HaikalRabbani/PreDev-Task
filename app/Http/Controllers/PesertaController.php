<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = Peserta::all();
        return view('peserta.index', compact('peserta'));
    }

    public function create()
    {
        return view('peserta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'alamat' => 'required|string|max:200',
            'jk'     => 'required|in:L,P',
        ]);

        Peserta::create($request->only('nama', 'alamat', 'jk'));

        return redirect()->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan!');
    }

public function update(Request $request, $id)
{
    $request->validate([
        'nama'   => 'required|string|max:100',
        'alamat' => 'required|string|max:200',
        'jk'     => 'required|in:L,P',
    ]);

    $peserta = Peserta::findOrFail($id);
    $peserta->update($request->only('nama', 'alamat', 'jk'));

    return redirect()->route('peserta.index')
        ->with('success', 'Peserta berhasil diupdate!');
}

public function destroy($id)
{
    $peserta = Peserta::findOrFail($id);
    $peserta->delete();

    return redirect()->route('peserta.index')
        ->with('success', 'Peserta berhasil dihapus!');
}

public function edit($id)
{
    $peserta = Peserta::findOrFail($id);
    return view('peserta.edit', compact('peserta'));
}
    
}