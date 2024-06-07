<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $user = new User();
        return view("admin/index", ['user' => $user->find(session('user_id'))]);
    }
}
