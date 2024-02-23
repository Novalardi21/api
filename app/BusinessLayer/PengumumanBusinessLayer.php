<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PengumumanBusinessLayer
{
    public function aksiTampilPengumuman(Request $request)
    {
        $data = Pengumuman::all();
        return $data;
    }

    public function aksiTambahPengumuman(array $data)
    {       
        $result = Pengumuman::create($data);

        return $result;
    }

    public function aksieditPengumuman($id, $data)
    {
        try {
            // Mengambil data yang ingin diubah
            $pengumuman = Pengumuman::findOrFail($id);

            // Mengupdate data
            $pengumuman->update($data);

            return true; // Jika berhasil mengubah data
        } catch (\Exception $e) {
            return false; // Jika gagal mengubah data
        }
    }

    public function aksihapusPengumuman($id)
    {
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return false; // Data tidak ditemukan
        }
        
        // Lakukan operasi delete
        $pengumuman->delete();

        return true;
    }
}