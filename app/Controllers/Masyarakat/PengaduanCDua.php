<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Helpers\BM25Helper;
use App\Libraries\BM25;
use App\Libraries\StopWord;
use App\Models\DataLatih;
use App\Models\DataUji;
use App\Models\PengaduanModel;
use App\Models\Tindakan;
use App\Models\User;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Math\Distance\Euclidean;
use Phpml\Math\Distance\Minkowski;
use Sastrawi\Stemmer\StemmerFactory;

class PengaduanCDua extends BaseController
{
    public function home()
    {
        return view('masyarakat/landing-page');
    }
    public function index()
    {
        $userM = new User();
        $user = $userM->find(session('user_id'));
        $pengaduan = new PengaduanModel();
        $data = $pengaduan->where('id_user', $user['id'])->findAll() ?? null;
        return view('masyarakat/index', [
            'user' => $user,
            'data' => $data
        ]);
    }

    public function store()
    {
        $input_bert = new \App\Controllers\Bahan\BertController;
        $input_bm25 = new \App\Controllers\Bahan\BM25Controller;
        $pengaduan = new PengaduanModel();
        $datauji = new DataUji();
        $text = $this->request->getPost('deskripsi');
        $foto = $this->request->getFile('foto');

        // Preprocess text
        $bertlatih = $input_bert->bert($text);
        $bm25latih = $input_bm25->hasil($bertlatih);

        // Direct matching for specific keywords
        $knn = $this->knn($bm25latih['bm25'], $bertlatih);

        if ($foto->getError() == 4) {
            $data = [
                'id_user' => session()->get('user_id'),
                'data_mentah' => $text,
                'data_cleaning' => $bertlatih,
            ];
        } else {
            $data = [
                'id_user' => session()->get('user_id'),
                'data_mentah' => $text,
                'data_cleaning' => $bertlatih,
                'foto' => $foto->getRandomName(),
            ];
            $foto->move('pengaduan-image', $data['foto']);
        }

        $pengaduan->insert($data);

        $datauji->insert([
            'nilai' => $bm25latih['bm25'][0],
            'kategori' => $knn,
            'id_user' => session()->get('user_id'),
            'id_pengaduan' => $pengaduan->getInsertID(),
        ]);

        session()->setFlashdata('message', 'Berhasil melakukan pengaduan.');
        session()->setFlashdata('message_type', 'success');
        return redirect()->back();
    }

    public function knn($bm25_score, $text)
    {
        $datalatih = new DataLatih();
        $data = $datalatih->findAll();
        $samples = [];
        $labels = [];

        // Label for each sample
        foreach ($data as $row) {
            $samples[] = [$row['nilai']];
            $labels[] = $row['kategori'];
        }

        // Keywords for each label
        $keywords = [
            'Kekerasan' => [
                "tendang", "hantam", "keras", "serang", "tebas", "bantai", "fisik", "tampar", "tonjok", "siksa",
                "pukul", "hajar", "tikam", "cekik", "bogem", "bacok", "tusuk", "gigit", "cambuk", "jotos", "seruduk",
                "sabet", "tindas", "sekap", "dobrak", "injak", "gantung", "sergap", "rampas", "gasak", "tumbuk",
                "gempur", "gedor", "pecut", "pedang", "tembak", "bom", "cidera", "darah", "korban"
            ],
            'Pencurian' => [
                "curi", "rampok", "sikat", "gondol", "jarah", "tilep", "selundup", "bajak",
                "maling", "dicuri", "copet", "gasak", "tilap", "sekong", "garong",
                "perampas", "tipu", "palsu", "gugat", "pencopet", "pengutil", "pemeras",
                "perampok", "penyelundup", "membobol", "menodong", "merampas", "menjarah",
                "mencopet", "membegal", "merampok", "membongkar", "meringkus", "mengutil",
                "mencuri", "membajak", "pencurian", "kriminal"
            ],
            'Penipuan' => [
                "tipu", "bohong", "kelabui", "palsu", "jebak", "ditipu", "manipulasi", "fiktif",
                "mengaku", "gadungan", "modus", "penipu", "tipuan", "menipu", "penggelapan",
                "korup", "pemalsuan", "hoaks", "tipu-tipu", "scam", "fraud", "penyelewengan",
                "perdaya", "rekayasa", "siasat", "iming-iming", "konspirasi", "pemerasan",
                "sogok", "sindikat", "uang palsu", "pencucian uang", "spekulasi", "aksi tipu",
                "bohongi", "pura-pura"
            ]
        ];
        

        // Flag to check if any keyword is matched
        $keywordMatched = false;

        // Check if text contains any of the keywords
        foreach ($keywords as $label => $labelKeywords) {
            foreach ($labelKeywords as $keyword) {
                if (strpos(strtolower($text), strtolower($keyword)) !== false) {
                    $keywordMatched = true;
                    return $label;
                }
            }
        }

        // If no keyword is matched, set flash message and return an error message
        if (!$keywordMatched) {
            session()->setFlashdata('message', 'Sistem tidak mendukung pengaduan selain Kekerasan, Pencurian, atau Penipuan.');
            session()->setFlashdata('message_type', 'error');
            return null; // Returning null or you could redirect to an error page
        }

        // Create instance of KNearestNeighbors with k=3
        $classifier = new KNearestNeighbors($k = 3);

        // Train the model with data and labels
        $classifier->train($samples, $labels);

        // New data to predict
        $newSample = [$bm25_score];

        // Predict label for new data
        $predictedLabel = $classifier->predict($newSample);

        return $predictedLabel;
    }



}
