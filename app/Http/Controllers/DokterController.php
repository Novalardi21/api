<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\DokterBusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class DokterController extends Controller 
{
    private $dokterBusinessLayer;

    public function __construct(DokterBusinessLayer $dokterBusinessLayer)
    {
        $this->dokterBusinessLayer = new DokterBusinessLayer;
    }

    public function tampilDokter(Request $request)
    {
        $result = $this->dokterBusinessLayer->aksiTampilDokter($request);
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tambahDokter(Request $request)
    {
        $currentTime = Carbon::now();

        $data = [
            'nama_dokter' => $request->input('nama_dokter', ''),
            'nama_dokter2' => $request->input('nama_dokter2', ''),
            'jam_praktek' => $request->input('jam_praktek', ''),
            'jam_praktek2' => $request->input('jam_praktek2', ''),
            'hari' => $request->input('hari', ''),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
        ];

        $result = $this->dokterBusinessLayer->aksiTambahDokter($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editDokter(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        $data = [
            'nama_dokter' => $request->input('nama_dokter', ''),
            'nama_dokter2' => $request->input('nama_dokter2', ''),
            'jam_praktek' => $request->input('jam_praktek', ''),
            'jam_praktek2' => $request->input('jam_praktek2', ''),
            'hari' => $request->input('hari', ''),
        ];
        // dd($data);
        $result = $this->dokterBusinessLayer->aksiEditDokter($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Jadwal Berhasil diubah'], 200);
        }
    
        return response()->json(['error' => 'Gagal mengubah status'], 401);
    }

    public function hapusDokter($id)
    {
        $result = $this->dokterBusinessLayer->aksiHapusDokter($id);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }


}