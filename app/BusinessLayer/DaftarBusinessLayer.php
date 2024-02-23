<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Daftar;
use Illuminate\Support\Facades\Auth;

class DaftarBusinessLayer
{
    public function aksiTampilDaftar(Request $request)
    {
        $query = Daftar::query(); // Menginisialisasi query builder
    
        if ($request->filled('nama_pasien')) {
            $query->where('nama_pasien', 'LIKE', '%' . $request->input('nama_pasien') . '%');
        }
    
        $data = $query->get(); // Mendapatkan hasil dari query builder
    
        return $data;
    }
    

    public function aksiTambahDaftar(array $data)
    {       
        $result = Daftar::create($data);

        return $result;
    }

    public function aksiEditStatus($id, $status)
    {
       
        $daftar = Daftar::find($id);

        if (!$daftar) {
            return false; // Tidak menemukan entitas dengan ID yang diberikan
        }

     
        $daftar->status = $status;
        $daftar->save();

        return true; // Berhasil mengubah status
    }

    public function aksiHapusDaftar($id)
    {
        $daftar = Daftar::find($id);

        if (!$daftar) {
            return false; // Data tidak ditemukan
        }

        // Lakukan operasi delete
        $daftar->delete();

        return true;
    }
}
