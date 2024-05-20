<?php
// File: app/Helpers/BM25Helper.php

namespace App\Helpers;

class BM25Helper
{

    public static function calculateTF($document, $term)
    {
        $words = str_word_count(strtolower($document), 1);
        $termFrequency = array_count_values($words);
        return $termFrequency[$term] ?? 0;
    }

    public static function calculateDF($corpus, $term)
    {
        $documentFrequency = 0;
        foreach ($corpus as $document) {
            if (stripos($document, $term) !== false) {
                $documentFrequency++;
            }
        }
        return $documentFrequency;
    }

    public static function calculateIDF($corpus, $term)
    {
        $documentFrequency = self::calculateDF($corpus, $term);
        $totalDocuments = count($corpus);
        return log(($totalDocuments + 1) / ($documentFrequency + 1)); // smoothing
    }
    public static function calculateBM25($document, $query, $k1, $b, $corpus)
    {
        $dl = str_word_count(strtolower($document));
        $avg_dl = array_sum(array_map('str_word_count', array_map('strtolower', $corpus))) / count($corpus);
        $score = 0;

        foreach ($query as $term) {
            $tf = self::calculateTF($document, $term);
            $df = self::calculateDF($corpus, $term);
            $idf = self::calculateIDF($corpus, $term);

            $score += $idf * (($tf * ($k1 + 1)) / ($tf + $k1 * (1 - $b + $b * ($dl / $avg_dl))));
        }

        return $score;
    }
}
