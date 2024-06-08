<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataLatih;
use App\Models\PengaduanModel;
use App\Models\Tindakan;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = new User();
        $tindakan = new Tindakan();
        $pengaduan = new PengaduanModel();
        $data_latih = new DataLatih();
        return view("admin/index", [
            'user' => $user->find(session('user_id')),
            'jumlahuser' => $user->countAllResults(),
            'jumlahpengaduan' => $pengaduan->countAllResults(),
            'jumlahtindakan' => $tindakan->countAllResults(),
            'jumlahdatalatih' => $data_latih->countAllResults(),
            'title' => 'Dashboard'
        ]);
    }
}
