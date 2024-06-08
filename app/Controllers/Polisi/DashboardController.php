<?php

namespace App\Controllers\Polisi;

use App\Controllers\BaseController;
use App\Models\Tindakan;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $tindakan = new Tindakan();
        $jumlah = $tindakan->countAllResults();
        return view(
            'polisi/index',
            [
                'title' => 'Dashboard',
                'jumlah'=>$jumlah
            ]
        );
    }
}
