<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;

class DokterBusinessLayer
{
    public function aksiTampilDokter(Request $request)
    {
        $data = Dokter::all();
        return $data;
    }

    public function aksiTambahDokter(array $data)
    {       
        $result = Dokter::create($data);

        return $result;
    }

    public function aksiEditDokter($id, $data)
    {
        try {
            $section = Dokter::findOrFail($id);


            $section->update([
                'nama_dokter' => $data['nama_dokter'],
                'nama_dokter2' => $data['nama_dokter2'],
                'jam_praktek' => $data['jam_praktek'],
                'jam_praktek2' => $data['jam_praktek2'],
                'hari' => $data['hari'],
                'created_at' => $section->created_at, // Tetapkan nilai created_at yang sudah ada
                'updated_at' => now(),
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function aksiHapusDokter($id)
    {
        $jadwal = Dokter::find($id);

        if (!$jadwal) {
            return false; // Data tidak ditemukan
        }

        // Lakukan operasi delete
        $jadwal->delete();

        return true;
    }
}
