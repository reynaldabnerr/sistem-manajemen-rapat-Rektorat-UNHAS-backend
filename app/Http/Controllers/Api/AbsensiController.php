<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_rapat' => 'required|exists:rapats,id',
            'nama_peserta' => 'required|string|max:255',
            'nip_peserta' => 'required|string|max:255',
            'status_kehadiran' => 'required|in:Hadir,Tidak Hadir',
        ]);

        $absensi = Absensi::create($data);

        return response()->json([
            'message' => 'Absensi berhasil ditambahkan.',
            'data' => $absensi
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_peserta' => 'required',
            'nip_peserta' => 'required',
            'status_kehadiran' => 'required|in:Hadir,Tidak Hadir',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($data);

        return response()->json($absensi);
    }

    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return response()->json(['message' => 'Absensi berhasil dihapus']);
    }

    public function show($id)
    {
        return Absensi::findOrFail($id);
    }
}
