<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Auth;

class GaleriBusinessLayer
{
    public function aksiTampilGaleri(Request $request)
    {
        $data = Galeri::all();
        return $data;
    }

    public function aksiTambahGaleri(array $data)
    {       
        $result = Galeri::create($data);

        return $result;
    }

    public function aksieditGaleri($id, $data)
    {
        try {
            // Mengambil data yang ingin diubah
            $galeri = Galeri::findOrFail($id);

            // Mengupdate data
            $galeri->update($data);

            return true; // Jika berhasil mengubah data
        } catch (\Exception $e) {
            return false; // Jika gagal mengubah data
        }
    }

    public function aksihapusGaleri($id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return false; // Data tidak ditemukan
        }
        
        // Lakukan operasi delete
        $galeri->delete();

        return true;
    }
    
}