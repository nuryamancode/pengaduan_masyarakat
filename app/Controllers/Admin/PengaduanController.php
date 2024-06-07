<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use CodeIgniter\HTTP\ResponseInterface;

class PengaduanController extends BaseController
{
    public function index()
    {
        $pengaduan = new PengaduanModel();
        $data = $pengaduan->findAll();
        return view('admin/kelola-pengaduan', ['data' => $data]);
    }
}
