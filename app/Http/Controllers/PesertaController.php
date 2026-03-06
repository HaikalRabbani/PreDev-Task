<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Event;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = Peserta::with('event')->get();
        $events  = Event::all();
        return view('peserta.index', compact('peserta', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'alamat'   => 'required|string|max:200',
            'jk'       => 'required|in:L,P',
            'event_id' => 'nullable|exists:event,id',
        ]);

        Peserta::create($request->only('nama', 'alamat', 'jk', 'event_id'));

        return redirect()->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'alamat'   => 'required|string|max:200',
            'jk'       => 'required|in:L,P',
            'event_id' => 'nullable|exists:event,id',
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update($request->only('nama', 'alamat', 'jk', 'event_id'));

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
}