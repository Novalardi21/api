<?php

namespace App\BusinessLayer;

use Illuminate\Http\Request;
use App\Models\Footer;
use Illuminate\Support\Facades\Auth;

class FooterBusinessLayer
{
    public function aksiTampilFooter(Request $request)
    {
        $data = Footer::all();
        return $data;
    }

    public function aksiTambahFooter(array $data)
    {       
        $result = Footer::create($data);

        return $result;
    }

    public function aksiEditFooter($id, $data)
    {
        try {
            $footer = Footer::findOrFail($id);


            $footer->update([
                'judul_footer' => $data['judul_footer'],
                'telepon' => $data['telepon'],
                'alamat' => $data['alamat'],
                'email' => $data['email'],
                'created_at' => $footer->created_at, // Tetapkan nilai created_at yang sudah ada
                'updated_at' => now(),
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function aksiHapusFooter($id)
    {
        $footer = Footer::find($id);

        if (!$footer) {
            return false; // Data tidak ditemukan
        }

        // Lakukan operasi delete
        $footer->delete();

        return true;
    }
}
