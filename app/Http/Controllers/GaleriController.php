<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\GaleriBusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Galeri;

class GaleriController extends Controller 
{
    private $galeriBusinessLayer;

    public function __construct(GaleriBusinessLayer $galeriBusinessLayer)
    {
        $this->galeriBusinessLayer = new GaleriBusinessLayer;
    }

    public function tampilGaleri(Request $request)
    {
        $result = $this->galeriBusinessLayer->aksiTampilGaleri($request);
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tambahGaleri(Request $request)
    {
        $currentTime = Carbon::now();

        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('gambar');
        $data = [
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
            'gambar' => $gambarPath, 
        ];

        $result = $this->galeriBusinessLayer->aksiTambahGaleri($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editGaleri(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        // Mengambil data yang ingin diubah
        $galeri = Galeri::findOrFail($id);
    
        // Jika terdapat file gambar baru yang diunggah, simpan gambar baru dan hapus gambar lama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete($galeri->gambar);
    
            // Simpan gambar baru
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('gambar');
        } else {
            // Jika tidak ada file gambar baru diunggah, gunakan gambar yang sudah ada
            $gambarPath = $galeri->gambar;
        }
    
        // Membuat array data untuk diupdate
        $data = [
            'gambar' => $gambarPath,
            'updated_at' => $currentTime
        ];
    
        // Menggunakan business layer untuk mengupdate data
        $result = $this->galeriBusinessLayer->aksieditGaleri($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil diubah'], 200);
        } else {
            return response()->json(['error' => 'Gagal mengubah data'], 401);
        }
    }

    public function hapusGaleri($id)
    {
        $result = $this->galeriBusinessLayer->aksihapusGaleri($id);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }



}