<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataLatih;
use CodeIgniter\HTTP\ResponseInterface;
use Phpml\Classification\KNearestNeighbors;

class DataLatihController extends BaseController
{
    public function index()
    {
        return view(
            'admin/index',
        );
    }

    public function store()
    {
        $input_bert = new \App\Controllers\Bahan\BertController;
        $input_bm25 = new \App\Controllers\Bahan\BM25Controller;
        $text = $this->request->getPost('text');
        $kategori = $this->request->getPost('kategori');
        $datalatih = new DataLatih();
        $bertlatih = $input_bert->bert($text);
        $bm25latih = $input_bm25->hasil($bertlatih);
        $datalatih->insert([
            'nilai' => $bm25latih['bm25'][0],
            'kategori' => $kategori
        ]);
        return redirect()->back()->with('success', 'Berhasil');
    }

    public function knn()
    {
        $datalatih = new DataLatih();
        $data = $datalatih->findAll();
        $samples = [];

        foreach ($data as $row) {
            $samples[] = [$row->nilai];
        }
        // Label untuk setiap sampel
        $labels = [];
        foreach ($data as $row) {
            $labels[] = $row->kategori;
        }
        
        // Membuat instance KNearestNeighbors dengan k=3
        $classifier = new KNearestNeighbors($k=3);
        
        // Melatih model dengan data dan label
        $classifier->train($samples, $labels);
        // Data baru yang ingin diprediksi
        $newSample = [
            ['1'],
            ['2'],
            ['2'],
        ];
        // dd($newSample);
        
        // Memprediksi label untuk data baru
        $predictedLabel = $classifier->predict($newSample);
        dd($predictedLabel);
        
    }

    public function delete($id)
    {
        $datalatih = new DataLatih();
        $datalatih->delete($id);
        return redirect()->to('/admin/data-latih');
    }
}
