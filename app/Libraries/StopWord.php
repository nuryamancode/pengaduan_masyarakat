<?php

namespace App\Libraries;

class StopWord
{
    protected $stopWords = [];

    public function __construct()
    {
        // Ambil stop words dari file
        $this->stopWords = file('resources/stopword.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    public function filterText($text)
    {
        // Hapus stop words dari teks menggunakan regex
        $pattern = '/\b(' . implode('|', array_map('preg_quote', $this->stopWords)) . ')\b/i';
        $filteredText = preg_replace($pattern, '', $text);

        // Hapus spasi ganda yang mungkin dihasilkan setelah penghapusan stopwords
        $filteredText = preg_replace('/\s+/', ' ', $filteredText);
        return trim($filteredText);
    }
}
