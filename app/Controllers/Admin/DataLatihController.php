<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataLatih;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Phpml\Classification\KNearestNeighbors;

class DataLatihController extends BaseController
{
    public function index()
    {
        $datalatih = new DataLatih();
        $user = new User();
        $data = $datalatih->findAll();
        return view(
            'admin/data-latih',
            [
                'data' => $data,
                "user" => $user->find(session("user_id")),
                "title" => "Kelola Data Latih",
            ],
        );
    }

    public function store()
    {
        $input_bert = new \App\Controllers\Bahan\BertController;
        $input_bm25 = new \App\Controllers\Bahan\BM25Controller;
        $datalatih = new DataLatih();
        $text = $this->request->getPost('deskripsi');
        $kategori = $this->request->getPost('kategori');
        $bertlatih = $input_bert->bert($text);
        $bm25latih = $input_bm25->hasil($bertlatih);
        $datalatih->insert([
            'data_mentah' => $text,
            'nilai' => $bm25latih['bm25'][0],
            'kategori' => $kategori
        ]);
        session()->setFlashdata('message', 'Data berhasil ditambahkan.');
        session()->setFlashdata('message_type', 'success');
        return redirect()->back();
    }
    public function update($id)
    {
        $input_bert = new \App\Controllers\Bahan\BertController;
        $input_bm25 = new \App\Controllers\Bahan\BM25Controller;
        $datalatih = new DataLatih();
        $text = $this->request->getPost('deskripsi');
        $kategori = $this->request->getPost('kategori');
        $bertlatih = $input_bert->bert($text);
        $bm25latih = $input_bm25->hasil($bertlatih);
        $datalatih->update($id,[
            'data_mentah' => $text,
            'nilai' => $bm25latih['bm25'][0],
            'kategori' => $kategori
        ]);
        session()->setFlashdata('message', 'Data berhasil diubah.');
        session()->setFlashdata('message_type', 'success');
        return redirect()->back();
    }

    // public function knn($text)
    // {
    //     $datalatih = new DataLatih();
    //     $data = $datalatih->findAll();
    //     $samples = [];

    //     foreach ($data as $row) {
    //         $samples[] = [$row['nilai']];
    //     }
    //     // Label untuk setiap sampel
    //     $labels = [];
    //     foreach ($data as $row) {
    //         $labels[] = $row['kategori'];
    //     }

    //     // Membuat instance KNearestNeighbors dengan k=3
    //     $classifier = new KNearestNeighbors($k = 3);

    //     // Melatih model dengan data dan label
    //     $classifier->train($samples, $labels);
    //     // Data baru yang ingin diprediksi
    //     $newSample = $text;
    //     // dd($newSample);

    //     // Memprediksi label untuk data baru
    //     $predictedLabel = $classifier->predict($newSample);
    //     dd($predictedLabel);

    // }

    public function delete($id)
    {
        $datalatih = new DataLatih();
        $datalatih->delete($id);
        session()->setFlashdata('message', 'Data berhasil dihapus.');
        session()->setFlashdata('message_type', 'success');
        return redirect()->back();
    }
}
