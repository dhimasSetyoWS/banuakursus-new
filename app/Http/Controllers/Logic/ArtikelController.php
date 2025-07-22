<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    //
    public function store(Request $request) {
        $request->validate([
            'judul' => ['required' , 'string'],
            'konten' => ['required' , 'string'],
        ]);

        Artikel::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return redirect()->route('article')->with('success' , 'Berhasil tambah Artikel!');
    }
    public function delete(Artikel $artikel) {
        $artikel->delete();
    }
}
