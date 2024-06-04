<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        if (session('user_id')) {
            if (session('user_level') == 'user') {
                return redirect()->to(site_url('pengaduan'));
            }elseif (session('user_level') == 'admin') {
                return redirect()->to(site_url('adminn'));
            }elseif (session('user_level') == 'polisi') {
                return redirect()->to(site_url('pengaduan'));
            }
        }
        return view('auth/login');
    }
    public function register()
    {
        if (session('user_id')) {
            if (session('user_level') == 'user') {
                return redirect()->to(site_url('pengaduan'));
            }elseif (session('user_level') == 'admin') {
                return redirect()->to(site_url('adminn'));
            }elseif (session('user_level') == 'polisi') {
                return redirect()->to(site_url('pengaduan'));
            }
        }
        return view('auth/register');
    }

    public function prosesLogin()
    {
        $session = session();
        $model = new User();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $session->set('islogin', true);
            $session->set('user_id', $user['id']);
            $session->set('user_level', $user['level']);
            if ($user['level'] == 'admin') {
                return redirect()->to(site_url('dashboard'));
            } elseif ($user['level'] == 'user') {
                return redirect()->to(site_url('pengaduan'));
            } elseif ($user['level'] == 'polisi') {
                return redirect()->to(site_url('dashboard'));
            }
        } else {
            return redirect()->to(site_url('login'))->with('error', "Invalid Credential");
        }
    }

    public function prosesRegister()
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $tempat = $this->request->getVar('tempat');
        $tgl_lahir = $this->request->getVar('tgl_lahir');
        $username = $this->request->getVar('username');
        $jenis_kelamin = $this->request->getVar('jenis_kelamin');
        $password = $this->request->getVar('password');

        // Memastikan semua variabel memiliki nilai yang valid
        if (is_null($nama) || is_null($email) || is_null($tempat) || is_null($tgl_lahir) || is_null($username) || is_null($jenis_kelamin) || is_null($password)) {
            return redirect()->back()->withInput()->with('error', 'Semua bidang harus diisi.');
        }

        $model = new User();

        $data = [
            'nama' => $nama,
            'email' => $email,
            'tempat' => $tempat,
            'tgl_lahir' => $tgl_lahir,
            'username' => $username,
            'jenis_kelamin' => $jenis_kelamin,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => 'user'
        ];

        $model->save($data);

        return redirect()->to(site_url('login'))->with('success', "Registration Successful");
    }

}
