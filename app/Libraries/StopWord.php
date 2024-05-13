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
        // Hapus stop words dari teks
        $filteredText = preg_replace('/\b(' . implode('|', $this->stopWords) . ')\b/i', '', $text);
        return $filteredText;
    }
}
