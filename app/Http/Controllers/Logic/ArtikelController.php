<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string'],
            'konten' => ['required', 'string'],
        ]);

        Artikel::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return redirect()->route('article')->with('success', 'Berhasil tambah Artikel!');
    }

    public function edit(Artikel $artikel)
    {
        echo $artikel;
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => ['required', 'string'],
            'konten' => ['required', 'string'],
        ]);

        $artikel->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return redirect()->route('article')->with('success', 'Berhasil edit Artikel');
    }

    public function delete(Artikel $artikel)
    {
        if($artikel->delete()) {
            return redirect()->back()->with('success' , 'Artikel berhasil di hapus');
        }
        return redirect()->back()->with('error' , 'Artikel gagal di hapus');


    }
}
