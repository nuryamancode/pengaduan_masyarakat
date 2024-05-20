<?php

namespace App\Controllers\Bahan;

use App\Controllers\BaseController;
use App\Libraries\StopWord;
use CodeIgniter\HTTP\ResponseInterface;
use Sastrawi\Stemmer\StemmerFactory;

class BertController extends BaseController
{


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
