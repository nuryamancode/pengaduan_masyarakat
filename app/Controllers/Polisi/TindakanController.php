<?php

namespace App\Controllers\Polisi;

use App\Controllers\BaseController;
use App\Models\Tindakan;
use CodeIgniter\HTTP\ResponseInterface;

class TindakanController extends BaseController
{
    public function index()
    {
        $tindakan = new Tindakan();
        $data = $tindakan->findAll();
        return view('polisi/tindakan', ['data' => $data]);
    }
}
