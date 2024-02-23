<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class staffBusinessLayer
{
    public function aksiTampilStaff(Request $request)
    {
        $data = Staff::all();
        return $data;
    }

    public function aksiTambahStaff(array $data)
    {       
        $result = Staff::create($data);

        return $result;
    }

    public function aksieditStaff($id, $data)
    {
        try {
            // Mengambil data yang ingin diubah
            $staff = Staff::findOrFail($id);

            // Mengupdate data
            $staff->update($data);

            return true; // Jika berhasil mengubah data
        } catch (\Exception $e) {
            return false; // Jika gagal mengubah data
        }
    }

    public function aksihapusStaff($id)
    {
        $staff = Staff::find($id);

        if (!$staff) {
            return false; // Data tidak ditemukan
        }
        
        // Lakukan operasi delete
        $staff->delete();

        return true;
    }

}