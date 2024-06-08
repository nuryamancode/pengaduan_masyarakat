<?php

namespace App\Controllers\Bahan;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use CodeIgniter\HTTP\ResponseInterface;

class BM25Controller extends BaseController
{
    public function hasil($corpus1)
    {

        $corpus = [
            $corpus1
        ];
        $query = [
            "tendang",
            "hantam",
            "keras",
            "serang",
            "tebas",
            "bantai",
            "tampar",
            "tonjok",
            "siksa",
            "curi",
            "rampok",
            "sikat",
            "gondol",
            "bangsat",
            "jarah",
            "tilep",
            "selundup",
            "bajak",
            "tipu",
            "bohong",
            "kelabui",
            "palsu",
            "jebak",
            "manipulasi",
            "fiktif"
        ];

        // Hitung TF
        $tf = $this->calculateTF($corpus, $query);
        
        // Hitung DF
        $df = $this->calculateDF($corpus, $query);
        
        // Hitung IDF
        $idf = $this->calculateIDF($corpus, $df);
        
        // Hitung Average Document Length
        $avgDocLength = $this->calculateAvgDocLength($corpus);
        
        // Hitung BM25
        $bm25 = $this->calculateBM25($corpus, $query, $tf, $idf, $avgDocLength);
        return [
            'tf' => $tf,
            'df' => $df,
            'idf' => $idf,
            'avgDocLength' => $avgDocLength,
            'bm25' => $bm25,
        ];
    }

    private function calculateTF($corpus, $query)
    {
        $tf = [];
        foreach ($corpus as $docIndex => $document) {
            $words = explode(' ', strtolower($document));
            $tf[$docIndex] = [];
            foreach ($query as $term) {
                $tf[$docIndex][$term] = array_count_values($words)[$term] ?? 0;
            }
        }
        return $tf;
    }

    private function calculateDF($corpus, $query)
    {
        $df = array_fill_keys($query, 0);
        foreach ($corpus as $document) {
            $words = explode(' ', strtolower($document));
            foreach ($query as $term) {
                if (in_array($term, $words)) {
                    $df[$term]++;
                }
            }
        }
        return $df;
    }

    private function calculateIDF($corpus, $df)
    {
        $totalDocuments = count($corpus);
        $idf = [];
        foreach ($df as $term => $freq) {
            if ($freq == 0) {
                $idf[$term] = 0; // Menghindari nilai IDF negatif jika df(t) = 0
            } else {
                $idf[$term] = log(($totalDocuments - $freq + 0.5) / ($freq + 0.5) + 1);
            }
        }
        return $idf;
    }

    private function calculateAvgDocLength($corpus)
    {
        $totalLength = array_sum(array_map('str_word_count', $corpus));
        return $totalLength / count($corpus);
    }

    private function calculateBM25($corpus, $query, $tf, $idf, $avgDocLength, $k1 = 1.5, $b = 0.75)
    {
        $bm25 = [];
        foreach ($corpus as $docIndex => $document) {
            $docLength = str_word_count($document);
            $score = 0;

            foreach ($query as $term) {
                if (isset($tf[$docIndex][$term])) {
                    $TF = $tf[$docIndex][$term];
                    $IDF = $idf[$term];

                    $numerator = ($TF * ($k1 + 1));
                    $denominator = ($TF + $k1 * (1 - $b + $b * ($docLength / $avgDocLength)));
                    $score += $IDF * ($numerator / $denominator);
                }
            }

            $bm25[$docIndex] = round($score, 1);
        }

        return $bm25;
    }


}
