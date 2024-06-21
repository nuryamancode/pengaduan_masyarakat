<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\Tindakan;
use CodeIgniter\HTTP\ResponseInterface;

class PengaduanController extends BaseController
{
    public function index()
    {
        $pengaduan = new PengaduanModel();
        $data = $pengaduan->findAll();
        return view('admin/kelola-pengaduan', ['data' => $data, 'title' => 'Kelola Pengaduan']);
    }
    public function delete($id)
    {
        $pengaduan = new PengaduanModel();
        $record = $pengaduan->find($id);
        if ($record) {
            $foto = 'pengaduan-image/' . $record['foto'];
            if ($pengaduan->delete($id)) {
                if (is_file($foto)) {
                    unlink($foto);
                }
                session()->setFlashdata('message', 'Data berhasil dihapus.');
                session()->setFlashdata('message_type', 'success');
            }
        } else {
            session()->setFlashdata('message', 'Data tidak ditemukan.');
            session()->setFlashdata('message_type', 'danger');
        }
        return redirect()->back();
    }

    public function accept($id)
    {
        $pengaduan = new PengaduanModel();
        $tindakan = new Tindakan();
        $record = $pengaduan->find($id);
        
        if ($record) {
            $pengaduan->update($id, ['status' => 'Sedang Ditinjau']);
            $id_user = $record['id_user'];
    
            $tindakan->insert([
                'id_pengaduan' => $id,
                'id_user' => $id_user,
            ]);
            
            session()->setFlashdata('message', 'Data diterima.');
            session()->setFlashdata('message_type', 'success');
        } else {
            session()->setFlashdata('message', 'Record not found.');
            session()->setFlashdata('message_type', 'error');
        }
        
        return redirect()->back();
    }
    
    public function reject($id)
    {
        $pengaduan = new PengaduanModel();
        $record = $pengaduan->find($id);
        if ($record) {
            $pengaduan->update($id, ['status' => 'Ditolak']);
            session()->setFlashdata('message', 'Data ditolak.');
            session()->setFlashdata('message_type', 'success');
        } else {
            session()->setFlashdata('message', 'Data tidak ditemukan.');
            session()->setFlashdata('message_type', 'danger');
        }
        return redirect()->back();
    }

}
