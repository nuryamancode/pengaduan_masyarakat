<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use CodeIgniter\HTTP\ResponseInterface;

class PengaduanController extends BaseController
{
    public function index()
    {
        return view('masyarakat/index');
    }

    public function store()
    {
        // $post = ;
        $pengaduan = new PengaduanModel();
        $pengaduan->insert($this->request->getPost());
        return redirect()->back()->with('success','Berhasil');
    }
}
