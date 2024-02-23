<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\Section2BusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Section2;

class Section2Controller extends Controller 
{

    private $section2BusinessLayer;

    public function __construct(Section2BusinessLayer $section2BusinessLayer)
    {
        $this->section2BusinessLayer = new Section2BusinessLayer;
    }



    public function tampilHero(Request $request)
    {
        $result = $this->section2BusinessLayer->aksiTampilHero('hero', $request);
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tampilVisi(Request $request)
    {
        $result = $this->section2BusinessLayer->aksiTampilVisi('visi', $request);
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tambahSection2(Request $request)
    {
        $currentTime = Carbon::now();

        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('gambar');
        $data = [
            'judul' => $request->input('judul', ''),
            'deskripsi' => $request->input('deskripsi', ''),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
            'tipe_section' => $request->input('tipe_section', ''),
            'gambar' => $gambarPath, 
        ];

        $result = $this->section2BusinessLayer->aksiTambahSection2($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editSection2(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        // Mengambil data yang ingin diubah
        $section = Section2::findOrFail($id);
    
        // Jika terdapat file gambar baru yang diunggah, simpan gambar baru dan hapus gambar lama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete($section->gambar);
    
            // Simpan gambar baru
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('gambar');
        } else {
            // Jika tidak ada file gambar baru diunggah, gunakan gambar yang sudah ada
            $gambarPath = $section->gambar;
        }
    
        // Membuat array data untuk diupdate
        $data = [
            'judul' => $request->input('judul', $section->judul),
            'deskripsi' => $request->input('deskripsi', $section->deskripsi),
            'tipe_section' => $request->input('tipe_section', $section->tipe_section),
            'gambar' => $gambarPath,
            'updated_at' => $currentTime
        ];
    
        // Menggunakan business layer untuk mengupdate data
        $result = $this->section2BusinessLayer->aksieditSection2($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil diubah'], 200);
        } else {
            return response()->json(['error' => 'Gagal mengubah data'], 401);
        }
    }

    public function hapusSection2($id)
    {
        $result = $this->section2BusinessLayer->aksihapusSection2($id);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }

}