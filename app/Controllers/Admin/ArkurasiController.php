<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DataLatih;
use App\Models\DataUji;
use CodeIgniter\HTTP\ResponseInterface;

class ArkurasiController extends BaseController
{
    public function index()
    {
        $modelLatih = new DataLatih();
        $modelUji = new DataUji();

        $dataLatih = $modelLatih->findAll(); // Data latih sebagai referensi
        $dataUji = $modelUji->findAll(); // Data uji yang akan dibandingkan

        $tp = 0; // True Positives
        $tn = 0; // True Negatives
        $fp = 0; // False Positives
        $fn = 0; // False Negatives

        foreach ($dataUji as $uji) {
            $actual = $uji['kategori']; // Kategori asli dari data uji
            $predicted = $uji['nilai']; // Hasil prediksi dari model

            // Cari nilai terdekat dari data latih
            $closest = null;
            $minDiff = PHP_FLOAT_MAX;

            foreach ($dataLatih as $latih) {
                $diff = abs($latih['nilai'] - $predicted);
                if ($diff < $minDiff) {
                    $minDiff = $diff;
                    $closest = $latih;
                }
            }

            $predictedCategory = $closest ? $closest['kategori'] : null;

            // Evaluasi hasil prediksi
            if ($actual == $predictedCategory) {
                $tp++;
            } elseif ($actual != $predictedCategory && $predictedCategory !== null) {
                $fp++;
            } elseif ($actual != $predictedCategory && $predictedCategory === null) {
                $fn++;
            } else {
                $tn++;
            }
        }

        // Menghitung metrik evaluasi
        $accuracy = ($tp + $tn) / max(1, ($tp + $tn + $fp + $fn));
        $precision = $tp / max(1, ($tp + $fp));
        $recall = $tp / max(1, ($tp + $fn));
        $f1_score = 2 * (($precision * $recall) / max(1, ($precision + $recall)));

        return view('admin/akurasi', [
            'data' => [
                'accuracy' => round($accuracy, 4),
                'precision' => round($precision, 4),
                'recall' => round($recall, 4),
                'f1_score' => round($f1_score, 4)
            ],
            'title' => 'Akurasi'
        ]);
    }
}
