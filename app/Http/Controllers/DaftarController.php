<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\DaftarBusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class DaftarController extends Controller 
{
    private $daftarBusinessLayer;

    public function __construct(DaftarBusinessLayer $daftarBusinessLayer)
    {
        $this->daftarBusinessLayer = new DaftarBusinessLayer;
    }

    public function tampilDaftar(Request $request)
    {
        // Panggil business layer untuk melakukan aksi tampil daftar
        $result = $this->daftarBusinessLayer->aksiTampilDaftar($request);
        
        // Berhasil, kembalikan respons dalam bentuk JSON
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }


    public function tambahDaftarPasien(Request $request)
    {
        $currentTime = Carbon::now();

        $data = [
            'nama_pasien' => $request->input('nama_pasien', ''),
            'ttl' => $request->input('ttl', ''),
            'jenis_kelamin' => $request->input('jenis_kelamin', ''),
            'telepon' => $request->input('telepon', ''),
            'alamat' => $request->input('alamat', ''),
            'status' => $request->input('status', 'Belum Ditangani'),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
        ];

        $result = $this->daftarBusinessLayer->aksiTambahDaftar($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editStatus(Request $request, $id)
    {
        $status = $request->input('status');

        $result = $this->daftarBusinessLayer->aksiEditStatus($id, $status);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Status Berhasil diubah'], 200);
        }

        return response()->json(['error' => 'Gagal mengubah status'], 401);
    }

    public function hapusDaftarPasien($id)
    {
        $result = $this->daftarBusinessLayer->aksiHapusDaftar($id);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }
}