<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\FooterBusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class FooterController extends Controller 
{
    private $footerBusinessLayer;

    public function __construct(FooterBusinessLayer $footerBusinessLayer)
    {
        $this->footerBusinessLayer = new FooterBusinessLayer;
    }

    public function tampilFooter(Request $request)
    {
        $result = $this->footerBusinessLayer->aksiTampilFooter($request);
        
        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tambahFooter(Request $request)
    {
        $currentTime = Carbon::now();

        $data = [
            'judul_footer' => $request->input('judul_footer', ''),
            'telepon' => $request->input('telepon', ''),
            'alamat' => $request->input('alamat', ''),
            'email' => $request->input('email', ''),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
        ];

        $result = $this->footerBusinessLayer->aksiTambahFooter($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editFooter(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        $data = [
            'judul_footer' => $request->input('judul_footer', ''),
            'telepon' => $request->input('telepon', ''),
            'alamat' => $request->input('alamat', ''),
            'email' => $request->input('email', '')
        ];
        // dd($data);
        $result = $this->footerBusinessLayer->aksiEditFooter($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Footer Berhasil diubah'], 200);
        }
    
        return response()->json(['error' => 'Gagal mengubah status'], 401);
    }


    public function hapusFooter($id)
    {
        $result = $this->footerBusinessLayer->aksiHapusFooter($id);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }
}