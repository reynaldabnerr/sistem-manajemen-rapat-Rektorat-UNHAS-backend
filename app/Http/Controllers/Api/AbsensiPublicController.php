<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rapat;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiPublicController extends Controller
{
    // Ambil detail rapat berdasarkan link absensi
    public function getRapatByLink($link_absensi)
    {
        $rapat = Rapat::where('link_absensi', $link_absensi)->first();

        if (!$rapat) {
            return response()->json(['message' => 'Link absensi tidak ditemukan'], 404);
        }

        return response()->json($rapat);
    }

    // Simpan data absensi peserta
    public function submitAbsensi(Request $request, $link_absensi)
{
    $rapat = Rapat::where('link_absensi', $link_absensi)->first();

    if (!$rapat) {
        return response()->json(['message' => 'Link absensi tidak ditemukan'], 404);
    }

    $validated = $request->validate([
        'nama_peserta' => 'required|string|max:255',
        'nip_peserta' => 'required|string|max:255',
        'status_kehadiran' => 'required|in:Hadir,Tidak Hadir',
    ]);

    $absensi = Absensi::create([
        'id_rapat' => $rapat->id,
        'nama_peserta' => $validated['nama_peserta'],
        'nip_peserta' => $validated['nip_peserta'],
        'status_kehadiran' => $validated['status_kehadiran'],
    ]);

    return response()->json([
        'message' => 'Absensi berhasil disimpan',
        'data' => $absensi,
    ], 201);
}

}
