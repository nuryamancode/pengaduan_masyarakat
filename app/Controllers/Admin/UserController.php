<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $data = $userModel->findAll();
        $filteredData = array_filter($data, function ($item) {
            return $item['level'] === 'user' || $item['level'] === 'polisi';
        });
        $viewData = [
            'data' => $filteredData,
            "user" => $userModel->find(session("user_id")),
            "title" => "Kelola User",
        ];
        return view('admin/kelola-user', $viewData);
    }


    public function update($id)
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $tempat = $this->request->getVar('tempat');
        $tgl_lahir = $this->request->getVar('tgl_lahir');
        $jenis_kelamin = $this->request->getVar('jenis_kelamin');
        $user = new User();

        // Mengambil data pengguna dari database
        $data = $user->find($id);

        // Memastikan data ditemukan sebelum melakukan pembaruan
        if ($data) {
            // Melakukan pembaruan data
            $user->update($id, [
                'nama' => $nama,
                'email' => $email,
                'tempat' => $tempat,
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => $jenis_kelamin,
            ]);

            return redirect()->back()->with('success', 'Berhasil');
        } else {
            // Menangani kasus di mana data tidak ditemukan
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function delete($id)
    {
        $userModel = new User();

        // Mencari pengguna berdasarkan ID
        $user = $userModel->find($id);

        // Memastikan pengguna ditemukan sebelum menghapus
        if ($user) {
            // Melakukan penghapusan data
            $userModel->delete($id);

            return redirect()->back()->with('success', 'Data pengguna berhasil dihapus.');
        } else {
            // Menangani kasus di mana data pengguna tidak ditemukan
            return redirect()->back()->with('error', 'Data pengguna tidak ditemukan.');
        }
    }


}
