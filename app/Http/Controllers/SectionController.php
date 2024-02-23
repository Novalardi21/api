<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLayer\SectionBusinessLayer; 
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SectionController extends Controller {

    private $sectionBusinessLayer;

    public function __construct(SectionBusinessLayer $sectionBusinessLayer)
    {
        $this->sectionBusinessLayer = new SectionBusinessLayer;
    }

    public function tampilAbout(Request $request)
    {
        $result = $this->sectionBusinessLayer->aksiTampilAbout('about', $request);
        
          return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function tampilPelayanan(Request $request)
    {
        $result = $this->sectionBusinessLayer->aksiTampilPelayanan('services', $request);
        
          return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }


    public function tambahAbout(Request $request)
    {
        $currentTime = Carbon::now();

        $data = [
            'judul' =>  '',
            'sub_judul' => '',
            'deskripsi' => $request->input('deskripsi', ''),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
            'tipe_section' => $request->input('tipe_section', 'About'),
        ];

        $result = $this->sectionBusinessLayer->aksiTambahSection($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }


    public function tambahServices(Request $request)
    {
        $currentTime = Carbon::now();

        $data = [
            'judul' => '',
            'sub_judul' => $request->input('sub_judul', ''),
            'deskripsi' => $request->input('deskripsi', ''),
            'created_at' => $currentTime,
            'updated_at' => $currentTime,
            'tipe_section' => $request->input('tipe_section', 'services'),
        ];

        $result = $this->sectionBusinessLayer->aksiTambahSection($data);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil disimpan'], 200);
        }

        return response()->json(['error' => 'Gagal menyimpan data'], 401);
    }

    public function editAbout(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        $data = [
            'deskripsi' => $request->input('deskripsi', ''),
        ];
        // dd($data);
        $result = $this->sectionBusinessLayer->aksiEditAbout($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'About Berhasil diubah'], 200);
        }
    
        return response()->json(['error' => 'Gagal mengubah status'], 401);
    }


    public function editServices(Request $request, $id)
    {
        $currentTime = Carbon::now();
    
        $data = [
            'sub_judul' => $request->input('sub_judul', ''),
            'deskripsi' => $request->input('deskripsi', ''),
        ];
        // dd($data);
        $result = $this->sectionBusinessLayer->aksiEditServices($id, $data);
    
        if ($result) {
            return response()->json(['success' => true, 'message' => 'About Berhasil diubah'], 200);
        }
    
        return response()->json(['error' => 'Gagal mengubah status'], 401);
    }


    public function hapusSection($id)
    {
        $result = $this->sectionBusinessLayer->aksihapusSection($id);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Data Berhasil dihapus'], 200);
        }

        return response()->json(['error' => 'Gagal menghapus data'], 500);
    }

}