<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\StaffBusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Staff;

class StaffController extends Controller 
{
    private $staffBusinessLayer;

    public function __construct(StaffBusinessLayer $staffBusinessLayer)
    {
        $this->staffBusinessLayer = new StaffBusinessLayer;
    }

    public function tampilStaff(Request $request)
    {
        $result = $this->staffBusinessLayer->aksiTampilStaff($request);
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tambahStaff(Request $request)
    {
        $currentTime = Carbon::now();

        $foto = $request->file('foto');
        $fotoPath = $foto->store('gambar');
        $data = [
            'nama' => $request->input('nama', ''),
            'jabatan' => $request->input('jabatan', ''),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
            'foto' => $fotoPath, 
        ];

        $result = $this->staffBusinessLayer->aksiTambahStaff($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editStaff(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        // Mengambil data yang ingin diubah
        $staff = Staff::findOrFail($id);
    
        // Jika terdapat file gambar baru yang diunggah, simpan gambar baru dan hapus gambar lama
        if ($request->hasFile('foto')) {
            // Hapus gambar lama
            Storage::delete($staff->foto);
    
            // Simpan gambar baru
            $foto = $request->file('foto');
            $fotoPath = $foto->store('gambar');
        } else {
            // Jika tidak ada file gambar baru diunggah, gunakan gambar yang sudah ada
            $fotoPath = $staff->foto;
        }
    
        // Membuat array data untuk diupdate
        $data = [
            'nama' => $request->input('nama', $staff->nama),
            'jabatan' => $request->input('jabatan', $staff->jabatan),
            'foto' => $fotoPath,
            'updated_at' => $currentTime
        ];
        // dd($data)
        // Menggunakan business layer untuk mengupdate data
        $result = $this->staffBusinessLayer->aksieditStaff($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil diubah'], 200);
        } else {
            return response()->json(['error' => 'Gagal mengubah data'], 401);
        }
    }

    public function hapusStaff($id)
    {
        $result = $this->staffBusinessLayer->aksihapusStaff($id);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }


}