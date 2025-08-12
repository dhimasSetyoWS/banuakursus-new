<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tugas;

class TugasController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'nama_tugas' => ['required' , 'string'],
            'isi_tugas' => ['required' , 'string'],
            'tenggat_waktu' => ['nullable' , 'date'],
        ]);

        Tugas::create([
            'nama_tugas' => $request->nama_tugas,
            'isi_tugas' => $request->isi_tugas,
            'tenggat_waktu' => $request->tenggat_waktu,
        ]);

        return redirect()->back()->with('success' , 'Berhasil bikin Tugas!');
    }

    public function edit() {
        echo "Edit Page";
    }

    public function update(Request $request, Tugas $tugas) {
        $request->validate([
            'nama_tugas' => ['required' , 'string'],
            'isi_tugas' => ['required' , 'string'],
            'tenggat_waktu' => ['nullable' , 'date'],
        ]);
        $tugas->update([
            'nama_tugas' => $request->nama_tugas,
            'isi_tugas' => $request->isi_tugas,
            'tenggat_waktu' => $request->tenggat_waktu,
        ]);

        return redirect()->back()->with('success' , 'Berhasil edit Tugas!');
    }

    public function delete(Tugas $tugas) {
        $tugas->delete();
        return redirect()->back()->with('success' , 'Berhasil hapus Tugas!');
    }
}
