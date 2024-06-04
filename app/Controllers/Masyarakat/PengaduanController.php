<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use App\Helpers\BM25Helper;
use App\Libraries\BM25;
use App\Libraries\StopWord;
use App\Models\DataLatih;
use App\Models\DataUji;
use App\Models\PengaduanModel;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Math\Distance\Minkowski;
use Sastrawi\Stemmer\StemmerFactory;


class PengaduanController extends BaseController
{
    public function home()
    {
        if (session('user_id')) {
            if (session('user_level') == 'user') {
                return redirect()->to(site_url('pengaduan'));
            } elseif (session('user_level') == 'admin') {
                return redirect()->to(site_url('adminn'));
            } elseif (session('user_level') == 'polisi') {
                return redirect()->to(site_url('pengaduan'));
            }
        }
        return view('masyarakat/landing-page');
    }
    public function index()
    {
        $item = new PengaduanModel();

        return view('masyarakat/index', ['item' => $item->findAll()]);
    }

    // public function store()
    // {
    //     $description = $this->request->getPost('description');
    //     $bm25value = $this->bert($description);
    //     $result = $this->hasil($bm25value);
    //     dd($result);
    //     $pengaduan = new PengaduanModel();
    //     $pengaduan->insert(['description' => $bm25value]);
    //     // foreach ($bm25value as $item) {
    //     // }
    //     return redirect()->back()->with('success', 'Berhasil');
    // }

    public function store()
    {
        $input_bert = new \App\Controllers\Bahan\BertController;
        $input_bm25 = new \App\Controllers\Bahan\BM25Controller;
        $pengaduan = new PengaduanModel();
        $datauji = new DataUji();
        $text = $this->request->getPost('description');
        // $kategori = $this->request->getPost('kategori');
        $bertlatih = $input_bert->bert($text);
        $bm25latih = $input_bm25->hasil($bertlatih);
        $knn = $this->knn($bm25latih['bm25']);
        $datauji->insert([
            'nilai' => $bm25latih['bm25'][0],
            'kategori' => $knn
        ]);
        $pengaduan->insert([
            'data_mentah' => $text,
            'data_cleaning' => $bertlatih,
        ]);
        return redirect()->back()->with('success', 'Berhasil');
    }

    public function knn($text)
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
        $classifier = new KNearestNeighbors($k = 3);

        // Melatih model dengan data dan label
        $classifier->train($samples, $labels);
        // Data baru yang ingin diprediksi
        $newSample = $text;
        // dd($newSample);

        // Memprediksi label untuk data baru
        $predictedLabel = $classifier->predict($newSample);
        return $predictedLabel;

    }

    // public function hasil($corpus1)
    // {

    //     $corpus = [
    //         $corpus1
    //     ];

    //     $query = ["bantu", "kemarin"];

    //     // Hitung TF
    //     $tf = $this->calculateTF($corpus, $query);

    //     // Hitung DF
    //     $df = $this->calculateDF($corpus, $query);

    //     // Hitung IDF
    //     $idf = $this->calculateIDF($corpus, $df);

    //     // Hitung Average Document Length
    //     $avgDocLength = $this->calculateAvgDocLength($corpus);

    //     // Hitung BM25
    //     $bm25 = $this->calculateBM25($corpus, $query, $tf, $idf, $avgDocLength);

    //     return $this->response->setJSON([
    //         'tf' => $tf,
    //         'df' => $df,
    //         'idf' => $idf,
    //         'avgDocLength' => $avgDocLength,
    //         'bm25' => $bm25,
    //     ]);
    // }

    // private function calculateTF($corpus, $query)
    // {
    //     $tf = [];
    //     foreach ($corpus as $docIndex => $document) {
    //         $words = explode(' ', strtolower($document));
    //         $tf[$docIndex] = [];
    //         foreach ($query as $term) {
    //             $tf[$docIndex][$term] = array_count_values($words)[$term] ?? 0;
    //         }
    //     }
    //     return $tf;
    // }

    // private function calculateDF($corpus, $query)
    // {
    //     $df = array_fill_keys($query, 0);
    //     foreach ($corpus as $document) {
    //         $words = explode(' ', strtolower($document));
    //         foreach ($query as $term) {
    //             if (in_array($term, $words)) {
    //                 $df[$term]++;
    //             }
    //         }
    //     }
    //     return $df;
    // }

    // private function calculateIDF($corpus, $df)
    // {
    //     $totalDocuments = count($corpus);
    //     $idf = [];
    //     foreach ($df as $term => $freq) {
    //         if ($freq == 0) {
    //             $idf[$term] = 0; // Menghindari nilai IDF negatif jika df(t) = 0
    //         } else {
    //             $idf[$term] = log(($totalDocuments - $freq + 0.5) / ($freq + 0.5) + 1);
    //         }
    //     }
    //     return $idf;
    // }

    // private function calculateAvgDocLength($corpus)
    // {
    //     $totalLength = array_sum(array_map('str_word_count', $corpus));
    //     return $totalLength / count($corpus);
    // }

    // private function calculateBM25($corpus, $query, $tf, $idf, $avgDocLength, $k1 = 1.5, $b = 0.75)
    // {
    //     $bm25 = [];
    //     foreach ($corpus as $docIndex => $document) {
    //         $docLength = str_word_count($document);
    //         $score = 0;

    //         foreach ($query as $term) {
    //             if (isset($tf[$docIndex][$term])) {
    //                 $TF = $tf[$docIndex][$term];
    //                 $IDF = $idf[$term];

    //                 $numerator = ($TF * ($k1 + 1));
    //                 $denominator = ($TF + $k1 * (1 - $b + $b * ($docLength / $avgDocLength)));
    //                 $score += $IDF * ($numerator / $denominator);
    //             }
    //         }

    //         $bm25[$docIndex] = round($score, 4);
    //     }

    //     return $bm25;
    // }


    // public function bert($text)
    // {
    //     $token = $this->token_lower_clean($text);
    //     $stopword = $this->stopwords($token);
    //     $steaming = $this->stemming($stopword);
    //     $penghapusan = $this->penghapusan($steaming);
    //     return $penghapusan;
    // }

    // public function search()
    // {
    //     $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
    //     $labels = ['Kekerasan', 'Penipuan', 'Pengangguran', 'ssds', 'Penipuan', 'Pengangguran'];

    //     $classifier = new KNearestNeighbors();
    //     $classifier->train($samples, $labels);
    //     $result = $classifier->predict([[3, 4], [1, 5]]);
    //     dd($result);

    //     $classifier->predict([[3, 2], [1, 5]]);
    //     // dd(['b', 'a']);
    // }

    // // public function penghapusan($text)
    // // {
    // //     $patterns = array(
    // //         '/nama[\s:]+[\w\s]+/i',
    // //         '/jl[\s:]+[\w\s]+/i',     
    // //         '/no[\s:]+[\d\s-]+/i',    
    // //         '/[\w.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',
    // //     );
    // //     $cleaned_data = preg_replace($patterns, '', $text);

    // //     return $cleaned_data;
    // //     // $identificationInfo = array("nama", "alamat", "nomor telepon", "email");
    // //     // $reportText = $text; // Inisialisasi $reportText dengan teks asli

    // //     // foreach ($identificationInfo as $info) {
    // //     //     // Perbaiki pola pencarian
    // //     //     $pattern = "/$info\s*:\s*[\w\s@.-]+/i";
    // //     //     $reportText = preg_replace($pattern, "", $reportText);
    // //     // }

    // //     // // return $reportText;
    // //     // $teks = preg_replace('/(jl\s+\w+\s+no\s+\d+)/i', '', $text);

    // //     // // Hilangkan nomor telepon
    // //     // $teks = preg_replace('/(\b\d{10,12}\b)/', '', $text);

    // //     // // Hilangkan email
    // //     // $teks = preg_replace('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/', '', $text);

    // //     // return $teks;
    // // }


    // // public function penghapusan($text){
    // //     // Pola pencarian yang diperbarui
    // //     $pattern = "/(?:nama|alamat|nomor telepon|email)\s+[^ ]+/i";

    // //     // Menghapus informasi yang cocok dengan pola pencarian
    // //     $reportText = preg_replace($pattern, "", $text);

    // //     return $reportText;
    // // }

    // //     public function test()
    // // {
    // //     $string = "nama budi alamat jalan pahlawan no 5 nomor telepon 089873612211 saudara heri pinjam uang besar janji kembali kurun 8 pinjam 7 maret 2019 sangkut sikap bayar hutang piutang kontak akses putus hubung saudara heri";

    // //     // Pola untuk menghapus informasi identifikasi
    // //     $patterns = [
    // //         '/\b(nama)\b\s+\w+/i',
    // //         '/\b(alamat)\b\s+(?:\w+\s*){1,5}/i',
    // //         '/\b(nomor telepon)\b\s+\d+/i',
    // //         '/\b(telepon)\b\s+\d+/i',
    // //         '/\b(alamat lengkap)\b\s+(?:\w+\s*){1,5}/i',
    // //         '/\b(jenis kelamin)\b\s+\w+/i',
    // //         '/\b(no ktp)\b\s+\w+/i',
    // //         '/\b(pekerjaan)\b\s+\w+/i'
    // //     ];

    // //     foreach ($patterns as $pattern) {
    // //         $string = preg_replace($pattern, '', $string);
    // //     }

    // //     // Menghapus spasi ganda dan memangkas spasi di awal dan akhir string
    // //     $hasil = preg_replace('/\s+/', ' ', trim($string));

    // //     echo "String awal: " . $string . "<br>";
    // //     echo "String setelah dihapus: " . $hasil;
    // // }

    // public function test()
    // {
    //     $text = 'saya lihat kasus tipu dan bantu untuk lapor kepada pihak wajib';
    //     $stopwords = new StopWord();
    //     $result = $stopwords->filterText($text);
    //     $cleanedText = preg_replace('/\s+/', ' ', $result);
    //     dd($cleanedText);
    // }

    // public function token_lower_clean($text)
    // {
    //     $tokens = preg_split('/\s+/', $text);
    //     $tokens = array_map(function ($token) {
    //         if (!empty($token)) {
    //             return preg_replace("/[^A-Za-z0-9]/", '', $token);
    //         }
    //         return $token;
    //     }, $tokens);
    //     $tokens = array_map('strtolower', $tokens);

    //     $tokens = array_filter($tokens);
    //     return implode(" ", $tokens);
    // }



    // public function penghapusan($text)
    // {
    //     $patterns = [
    //         '/\b(nama)\b\s+\w+/i',
    //         '/\b(email)\b\s+\w+/i',
    //         '/\b(alamat)\b\s+(?:\w+\s*){1,5}/i',
    //         '/\b(nomor telepon)\b\s+\d+/i',
    //         '/\b(telepon)\b\s+\d+/i',
    //         '/\b(alamat lengkap)\b\s+(?:\w+\s*){1,5}/i',
    //         '/\b(jenis kelamin)\b\s+\w+/i',
    //         '/\b(no ktp)\b\s+\w+/i',
    //         '/\b(pekerjaan)\b\s+\w+/i'
    //     ];

    //     foreach ($patterns as $pattern) {
    //         $text = preg_replace($pattern, '', $text);
    //     }

    //     $hasil = preg_replace('/\s+/', ' ', trim($text));
    //     return $hasil;
    // }

    // public function stemming($text)
    // {
    //     $stemmerFactory = new StemmerFactory();
    //     $stemmer = $stemmerFactory->createStemmer();
    //     $stemmedText = $stemmer->stem($text);
    //     return $stemmedText;
    // }
    // public function stopwords($text)
    // {
    //     $stopwords = new StopWord();
    //     $result = $stopwords->filterText($text);
    //     $cleanedText = preg_replace('/\s+/', ' ', $result);
    //     return $cleanedText;
    // }


}
