<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class SectionBusinessLayer
{
    public function aksiTampilAbout($tipeSection, Request $request)
    {
        $query = Section::where('tipe_section', $tipeSection);
    
        // Cek apakah ada parameter pencarian yang diterima dari request
        // if ($request->filled('judul')) {
        //     $query->where('judul', 'LIKE', '%' . $request->input('judul') . '%');
        // }
    
        $dataSection = $query->get();
    
        return $dataSection;
    }

    public function aksiTampilPelayanan($tipeSection, Request $request)
    {
        $query = Section::where('tipe_section', $tipeSection);
    
        // Cek apakah ada parameter pencarian yang diterima dari request
        // if ($request->filled('judul')) {
        //     $query->where('judul', 'LIKE', '%' . $request->input('judul') . '%');
        // }
    
        $dataSection = $query->get();
    
        return $dataSection;
    }

    public function aksiTambahSection(array $data)
    {       
        $result = Section::create($data);

        return $result;
    }

    // public function aksiTambahSection(array $data)
    // {       
    // // Jika data belum ada, maka create baru, jika sudah ada, maka update
    //     $result = Section::updateOrInsert(
    //      ['judul' => $data['judul']],
    //      [
    //         'deskripsi' => $data['deskripsi'],
    //         'created_at' => $data['created_at'],
    //         'updated_at' => $data['updated_at'],
    //         'tipe_section' => $data['tipe_section'],
    //         ]
    //     );

    //     return $result;
    // }


    public function aksihapusSection($id)
    {
        $section = Section::find($id);

        if (!$section) {
            return false; // Data tidak ditemukan
        }

        // Lakukan operasi delete
        $section->delete();

        return true;
    }

    public function aksiEditAbout($id, $data)
    {
        try {
            $section = Section::findOrFail($id);

         
            $section->update([
                'deskripsi' => $data['deskripsi'],
                'created_at' => $section->created_at, // Tetapkan nilai created_at yang sudah ada
                'updated_at' => now(),
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    public function aksiEditServices($id, $data)
    {
        try {
            $section = Section::findOrFail($id);

            $section->update([
                'sub_judul' => $data['sub_judul'],
                'deskripsi' => $data['deskripsi'],
                'created_at' => $section->created_at, // Tetapkan nilai created_at yang sudah ada
                'updated_at' => now(),
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}