<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class KategoriController extends Controller
{
    //
    public function store(Request $request) {
        $request->validate([
            'kategori' => ['string', 'max:150']
        ]);

        Kategori::create([
            'kategori' => $request->kategori,
            'slug' => Str::slug($request->kategori)
        ]);

        return redirect()->back()->with('success' , 'Kategori Berhasil Di Tambahkan');
    }

    public function delete(Kategori $kategori) {
        $kategori->delete();
        return redirect()->back()->with('success' , 'Kategori ' . $kategori->kategori .  ' Berhasil Di Hapus');
    }
    public function update(Request $request,Kategori $kategori) {
        $request->validate([
            'kategori' => ['string' , 'max:150']
        ]);
        $oldKat = $kategori->kategori;
        $succes = $kategori->update([
            'kategori' => $request->kategori,
            'slug' => Str::slug($request->kategori)
        ]);
        if ($succes) {
            return redirect()->back()->with('success' , 'Kategori ' . $oldKat .  ' Berhasil Di Update');
        }
        return redirect()->back()->with('error' , 'Kategori ' . $oldKat .  ' Gagal Di Update');
    }
}
