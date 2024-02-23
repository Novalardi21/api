<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Section2;
use Illuminate\Support\Facades\Auth;

class Section2BusinessLayer
{
    public function aksiTampilHero($tipeSection, Request $request)
    {
        $query = Section2::where('tipe_section', $tipeSection);
    
        // Cek apakah ada parameter pencarian yang diterima dari request
        // if ($request->filled('judul')) {
        //     $query->where('judul', 'LIKE', '%' . $request->input('judul') . '%');
        // }
    
        $dataSection = $query->get();
    
        return $dataSection;
    }
    
    public function aksiTampilVisi($tipeSection, Request $request)
    {
        $query = Section2::where('tipe_section', $tipeSection);
    
        // Cek apakah ada parameter pencarian yang diterima dari request
        // if ($request->filled('judul')) {
        //     $query->where('judul', 'LIKE', '%' . $request->input('judul') . '%');
        // }
    
        $dataSection = $query->get();
    
        return $dataSection;
    }

    public function aksiTambahSection2(array $data)
    {       
        $result = Section2::create($data);

        return $result;
    }

    public function aksieditSection2($id, $data)
    {
        try {
            // Mengambil data yang ingin diubah
            $section = Section2::findOrFail($id);

            // Mengupdate data
            $section->update($data);

            return true; // Jika berhasil mengubah data
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani dengan menampilkan pesan atau melakukan log
            // Di sini, Anda dapat menambahkan log atau pesan error sesuai kebutuhan aplikasi Anda
            return false; // Jika gagal mengubah data
        }
    }

    public function aksihapusSection2($id)
    {
        $section2 = Section2::find($id);

        if (!$section2) {
            return false; // Data tidak ditemukan
        }
        
        // Lakukan operasi delete
        $section2->delete();

        return true;
    }
}
