<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\PengumumanBusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengumuman;

class PengumumanController extends Controller 
{
    private $pengumumanBusinessLayer;

    public function __construct(PengumumanBusinessLayer $pengumumanBusinessLayer)
    {
        $this->pengumumanBusinessLayer = new PengumumanBusinessLayer;
    }

    public function tampilPengumuman(Request $request)
    {
        $result = $this->pengumumanBusinessLayer->aksiTampilPengumuman($request);
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tambahPengumuman(Request $request)
    {
        $currentTime = Carbon::now();

        $foto = $request->file('foto');
        $fotoPath = $foto->store('gambar');
        $data = [
            'judul' => $request->input('judul', ''),
            'isi' => $request->input('isi', ''),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
            'foto' => $fotoPath, 
        ];

        $result = $this->pengumumanBusinessLayer->aksiTambahPengumuman($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editPengumuman(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        // Mengambil data yang ingin diubah
        $pengumuman = Pengumuman::findOrFail($id);
    
        // Jika terdapat file gambar baru yang diunggah, simpan gambar baru dan hapus gambar lama
        if ($request->hasFile('foto')) {
            // Hapus gambar lama
            Storage::delete($pengumuman->foto);
    
            // Simpan gambar baru
            $foto = $request->file('foto');
            $fotoPath = $foto->store('gambar');
        } else {
            // Jika tidak ada file gambar baru diunggah, gunakan gambar yang sudah ada
            $fotoPath = $pengumuman->foto;
        }
    
        // Membuat array data untuk diupdate
        $data = [
            'judul' => $request->input('judul', $pengumuman->judul),
            'isi' => $request->input('isi', $pengumuman->isi),
            'foto' => $fotoPath,
            'updated_at' => $currentTime
        ];
        // dd($data)
        // Menggunakan business layer untuk mengupdate data
        $result = $this->pengumumanBusinessLayer->aksieditPengumuman($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil diubah'], 200);
        } else {
            return response()->json(['error' => 'Gagal mengubah data'], 401);
        }
    }

    public function hapusPengumuman($id)
    {
        $result = $this->pengumumanBusinessLayer->aksihapusPengumuman($id);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }

    


}