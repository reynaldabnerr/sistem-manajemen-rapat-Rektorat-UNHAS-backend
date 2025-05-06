<!DOCTYPE html>
<html>
<head>
    <title>Rekap Absensi</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Rekap Absensi - {{ $rapat->judul_rapat }}</h2>
    <p>Tanggal: {{ $rapat->tanggal_rapat }}</p>
    <p>Lokasi: {{ $rapat->lokasi_rapat }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP/NIK</th>
                <th>Status Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rapat->absensi as $a)
            <tr>
                <td>{{ $a->nama_peserta }}</td>
                <td>{{ $a->nip_peserta }}</td>
                <td>{{ $a->status_kehadiran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
