<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PengaduanController extends BaseController
{
    public function index()
    {
        return view('index');
    }
}
