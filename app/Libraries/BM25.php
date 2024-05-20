<?php

namespace App\Libraries;

class BM25
{
    protected $k1;
    protected $b;
    protected $documents;
    protected $avgDocLength;

    public function __construct($documents, $k1 = 1.5, $b = 0.75)
    {
        $this->documents = $documents;
        $this->k1 = $k1;
        $this->b = $b;
        $this->avgDocLength = $this->calculateAvgDocLength();
    }

    private function calculateAvgDocLength()
    {
        $totalLength = 0;
        foreach ($this->documents as $doc) {
            $totalLength += count($doc);
        }
        return $totalLength / count($this->documents);
    }

    private function termFrequency($term, $doc)
    {
        return array_count_values($doc)[$term] ?? 0;
    }

    private function documentFrequency($term)
    {
        $count = 0;
        foreach ($this->documents as $doc) {
            if (in_array($term, $doc)) {
                $count++;
            }
        }
        return $count;
    }

    private function idf($term)
    {
        $N = count($this->documents);
        $df = $this->documentFrequency($term);
        return log((($N - $df + 0.5) / ($df + 0.5)) + 1);
    }

    public function score($query, $document)
{
    $score = 0.0;
    foreach ($query as $term) {
        $tf = $this->termFrequency($term, $document);
        $idf = $this->idf($term);
        $docLength = count($document);
        
        // Ensure denominator is not zero
        if ($this->avgDocLength != 0) {
            $denominator = $tf + $this->k1 * (1 - $this->b + $this->b * ($docLength / $this->avgDocLength));
            $score += $idf * (($tf * ($this->k1 + 1)) / $denominator);
        }
    }
    return $score;
}

    

    public function rankDocuments($query)
    {
        $scores = [];
        foreach ($this->documents as $docId => $document) {
            $scores[$docId] = $this->score($query, $document);
        }
        arsort($scores);
        return $scores;
    }
}
