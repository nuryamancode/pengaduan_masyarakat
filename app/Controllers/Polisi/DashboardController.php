<?php

namespace App\Controllers\Polisi;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('polisi/index');
    }
}
