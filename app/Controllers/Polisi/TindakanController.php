<?php

namespace App\Controllers\Polisi;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\Tindakan;
use CodeIgniter\HTTP\ResponseInterface;

class TindakanController extends BaseController
{
    public function index()
    {
        $tindakan = new Tindakan();
        $excludedStatuses = ['Ditolak', 'Menunggu Konfirmasi'];
        $data = $tindakan->getTindakanWithExcludedStatuses($excludedStatuses);
        return view('polisi/tindakan', ['data' => $data, 'title' => 'Tindakan']);
    }

    public function update($id)
    {
        $tindakan = new Tindakan();
        $pengaduan = new PengaduanModel();
        $record = $tindakan->find($id);
        $status_tindakan = $this->request->getPost('tindakan');
        $lampiran = $this->request->getFile('lampiran');
        $keterangan = $this->request->getPost('keterangan');
        if ($lampiran->getError() == 4) {
            $data = [
                'keterangan' => $keterangan,
                'id_user' => session()->get('user_id'),
            ];
            $status = [
                'status' => $status_tindakan,
            ];
        } else {
            $data = [
                'keterangan' => $keterangan,
                'id_user' => session()->get('user_id'),
                'lampiran' => $lampiran->getRandomName(),
            ];
            $status = [
                'status' => $status_tindakan,
            ];
            $lampiran->move('lampiran-tindakan', $data['lampiran']);
        }
        if ($record) {
            $tindakan->update($id, $data);
            $pengaduan->update($record['id_pengaduan'], $status);
            session()->setFlashdata('message', 'Berhasil melakukan tindakan.');
            session()->setFlashdata('message_type', 'success');
            return redirect()->back();
        }
    }
}
