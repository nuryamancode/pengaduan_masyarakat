<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Tindakan;
use CodeIgniter\HTTP\ResponseInterface;

class TindakanController extends BaseController
{
    public function index()
    {
        $tindakan = new Tindakan();
        $data = $tindakan->findAll();
        return view('admin/kelola-tindakan', ['data' => $data]);
    }
}
