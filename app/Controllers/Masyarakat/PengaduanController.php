<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use App\Libraries\StopWord;
use App\Models\PengaduanModel;
use CodeIgniter\HTTP\ResponseInterface;
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Stemmers\PorterStemmer;
use Sastrawi\Stemmer\StemmerFactory;

class PengaduanController extends BaseController
{
    public function index()
    {
        return view('masyarakat/index');
    }

    public function store()
    {
        $description = $this->request->getPost('description');
        $bm25value = $this->bm25($description);
        // dd($bm25value);
        $pengaduan = new PengaduanModel();
        $pengaduan->insert(['description' => $bm25value]);
        return redirect()->back()->with('success', 'Berhasil');
    }

    public function bm25($text)
    {
        $token = $this->token_lower_clean($text);
        $stopword = $this->stopwords($token);
        $steaming = $this->stemming($stopword);
        $penghapusan = $this->penghapusan($steaming);
        dd($stopword);
    }



    // public function penghapusan($text)
    // {
    //     $patterns = array(
    //         '/nama[\s:]+[\w\s]+/i',
    //         '/jl[\s:]+[\w\s]+/i',     
    //         '/no[\s:]+[\d\s-]+/i',    
    //         '/[\w.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',
    //     );
    //     $cleaned_data = preg_replace($patterns, '', $text);

    //     return $cleaned_data;
    //     // $identificationInfo = array("nama", "alamat", "nomor telepon", "email");
    //     // $reportText = $text; // Inisialisasi $reportText dengan teks asli

    //     // foreach ($identificationInfo as $info) {
    //     //     // Perbaiki pola pencarian
    //     //     $pattern = "/$info\s*:\s*[\w\s@.-]+/i";
    //     //     $reportText = preg_replace($pattern, "", $reportText);
    //     // }

    //     // // return $reportText;
    //     // $teks = preg_replace('/(jl\s+\w+\s+no\s+\d+)/i', '', $text);

    //     // // Hilangkan nomor telepon
    //     // $teks = preg_replace('/(\b\d{10,12}\b)/', '', $text);

    //     // // Hilangkan email
    //     // $teks = preg_replace('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/', '', $text);

    //     // return $teks;
    // }


    // public function penghapusan($text){
    //     // Pola pencarian yang diperbarui
    //     $pattern = "/(?:nama|alamat|nomor telepon|email)\s+[^ ]+/i";

    //     // Menghapus informasi yang cocok dengan pola pencarian
    //     $reportText = preg_replace($pattern, "", $text);

    //     return $reportText;
    // }

    //     public function test()
    // {
    //     $string = "nama budi alamat jalan pahlawan no 5 nomor telepon 089873612211 saudara heri pinjam uang besar janji kembali kurun 8 pinjam 7 maret 2019 sangkut sikap bayar hutang piutang kontak akses putus hubung saudara heri";

    //     // Pola untuk menghapus informasi identifikasi
    //     $patterns = [
    //         '/\b(nama)\b\s+\w+/i',
    //         '/\b(alamat)\b\s+(?:\w+\s*){1,5}/i',
    //         '/\b(nomor telepon)\b\s+\d+/i',
    //         '/\b(telepon)\b\s+\d+/i',
    //         '/\b(alamat lengkap)\b\s+(?:\w+\s*){1,5}/i',
    //         '/\b(jenis kelamin)\b\s+\w+/i',
    //         '/\b(no ktp)\b\s+\w+/i',
    //         '/\b(pekerjaan)\b\s+\w+/i'
    //     ];

    //     foreach ($patterns as $pattern) {
    //         $string = preg_replace($pattern, '', $string);
    //     }

    //     // Menghapus spasi ganda dan memangkas spasi di awal dan akhir string
    //     $hasil = preg_replace('/\s+/', ' ', trim($string));

    //     echo "String awal: " . $string . "<br>";
    //     echo "String setelah dihapus: " . $hasil;
    // }

    public function test(){
        $text = 'saya lihat kasus tipu dan bantu untuk lapor kepada pihak wajib';
        $stopwords = new StopWord();
        $result = $stopwords->filterText($text);
        $cleanedText = preg_replace('/\s+/', ' ', $result);
        dd($cleanedText) ;
    }

    public function token_lower_clean($text)
    {
        $tokens = preg_split('/\s+/', $text);
        $tokens = array_map(function ($token) {
            if (!empty($token)) {
                return preg_replace("/[^A-Za-z0-9]/", '', $token);
            }
            return $token;
        }, $tokens);
        $tokens = array_map('strtolower', $tokens);

        $tokens = array_filter($tokens);
        return implode(" ", $tokens);
    }



    public function penghapusan($text)
    {
        $patterns = [
            '/\b(nama)\b\s+\w+/i',
            '/\b(email)\b\s+\w+/i',
            '/\b(alamat)\b\s+(?:\w+\s*){1,5}/i',
            '/\b(nomor telepon)\b\s+\d+/i',
            '/\b(telepon)\b\s+\d+/i',
            '/\b(alamat lengkap)\b\s+(?:\w+\s*){1,5}/i',
            '/\b(jenis kelamin)\b\s+\w+/i',
            '/\b(no ktp)\b\s+\w+/i',
            '/\b(pekerjaan)\b\s+\w+/i'
        ];

        foreach ($patterns as $pattern) {
            $text = preg_replace($pattern, '', $text);
        }

        $hasil = preg_replace('/\s+/', ' ', trim($text));
        return $hasil;
    }

    public function stemming($text)
    {
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();
        $stemmedText = $stemmer->stem($text);
        return $stemmedText;
    }
    public function stopwords($text)
    {
        $stopwords = new StopWord();
        $result = $stopwords->filterText($text);
        $cleanedText = preg_replace('/\s+/', ' ', $result);
        return $cleanedText;
    }
}
