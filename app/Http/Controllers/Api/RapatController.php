<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rapat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf; // ⬅️ CUKUP di sini saja, di luar class

class RapatController extends Controller
{
    public function index()
    {
        return Rapat::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_rapat' => 'required',
            'tanggal_rapat' => 'required|date',
            'lokasi_rapat' => 'required',
            'deskripsi_rapat' => 'nullable',
        ]);

        $data['link_absensi'] = Str::random(10);
        $rapat = Rapat::create($data);

        return response()->json($rapat, 201);
    }

    public function show($id)
    {
        return Rapat::with('absensi')->findOrFail($id); // Tambahkan 'with' biar ambil absensi sekalian
    }

    public function rekap($id)
    {
        $rapat = Rapat::with('absensi')->findOrFail($id);

        $pdf = Pdf::loadView('rekap_pdf', compact('rapat'));
        return $pdf->download("rekap_rapat_{$id}.pdf");
    }
    public function absensi($id)
    {
        $rapat = Rapat::with('absensi')->findOrFail($id);
        return response()->json($rapat->absensi);
    }   
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'judul_rapat' => 'required',
            'tanggal_rapat' => 'required|date',
            'lokasi_rapat' => 'required',
            'deskripsi_rapat' => 'nullable',
        ]);
    
        $rapat = Rapat::findOrFail($id);
        $rapat->update($data);
    
        return response()->json($rapat);
    }
    
    public function destroy($id)
    {
        $rapat = Rapat::findOrFail($id);
        $rapat->delete();
    
        return response()->json(['message' => 'Rapat berhasil dihapus']);
    }
    

}
