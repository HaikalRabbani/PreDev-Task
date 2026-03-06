<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
    $events = Event::orderBy('id', 'desc')->get();
    return view('event.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:100',
            'deskripsi'  => 'required|string',
            'tanggal'    => 'required|date',
            'lokasi'     => 'required|string|max:200',
            'status'     => 'required|in:aktif,selesai',
        ]);

        Event::create($request->only('nama_event', 'deskripsi', 'tanggal', 'lokasi', 'status'));

        return redirect()->route('event.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

        public function update(Request $request, $id)
    {
        $request->validate([
            'nama_event' => 'required|string|max:100',
            'deskripsi'  => 'required|string',
            'tanggal'    => 'required|date',
            'lokasi'     => 'required|string|max:200',
            'status'     => 'required|in:aktif,selesai',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->only('nama_event', 'deskripsi', 'tanggal', 'lokasi', 'status'));

        return redirect()->route('event.index')
            ->with('success', 'Event berhasil diupdate!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('event.index')
            ->with('success', 'Event berhasil dihapus!');
    }
}