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
        // token
        $token = $this->token_lower_clean($text);
        // penghapusan
        $penghapusan = $this->penghapusan($token);
        // steamming
        $steaming = $this->stemming($penghapusan);
        // stopword
        $stopword = $this->stopwords($steaming);
        return $stopword;
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




    public function token_lower_clean($text)
    {
        // $text = 'Pada 2018, ada penipuan dari SMS setelah tunjangan hari raya (THR) cair. SMS tersebut mencantumkan tautan laman yang berisi informasi hadiah.';
        $tokens = explode(" ", $text);
        $tokens = preg_replace("/[^A-Za-z0-9]/", '', $tokens);
        $tokens = array_map('strtolower', $tokens);
        return implode(" ", $tokens);
    }

    public function penghapusan($text)
    {
        $patterns = array(
            '/nama[\s:]+[\w\s]+/i',
            '/jl[\s:]+[\w\s]+/i',
            '/no[\s:]+[\d\s-]+/i',
            '/[\w.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',
        );
        $cleaned_data = preg_replace($patterns, '', $text);
        return $cleaned_data;
    }

    public function stemming($text)
    {
        // Contoh teks
        // $text = 'Pada 2018, ada penipuan dari SMS setelah tunjangan hari raya (THR) cair. SMS tersebut mengadukan tautan laman yang berisi informasi hadiah.';

        // Inisialisasi StemmerFactory
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        // Lakukan stemming pada teks
        $stemmedText = $stemmer->stem($text);

        // Output teks setelah stemming
        return $stemmedText;
    }
    public function stopwords($text)
    {
        // $text = 'Pada 2018, ada penipu/an dari SMS setelah tunjangan hari raya (THR) cair. SMS tersebut mencantumkan tautan laman yang berisi informasi hadiah.';
        $stopwords = new StopWord();
        $result = $stopwords->filterText($text);
        return $result;
    }
}
