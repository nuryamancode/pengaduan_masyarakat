<?php

namespace App\Controllers\Bahan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Math\Distance\Euclidean;
use Phpml\Math\Distance\Minkowski;

class KNNController extends BaseController
{
    public function index()
    {
        // Input text yang akan diprediksi
        $text = 0.35;
        $predictedLabel = $this->knn($text);
        echo "Predicted Label: " . $predictedLabel;
    }

    public function knn($text)
    {
        $data = [
            ['nilai' => 0.3, 'kategori' => 'kekerasan'],
            ['nilai' => 0.6, 'kategori' => 'penipuan'],
            ['nilai' => 0.3, 'kategori' => 'penipuan'],
            ['nilai' => 0.4, 'kategori' => 'pencurian'],
            ['nilai' => 0.4, 'kategori' => 'pencurian'],
            ['nilai' => 0.4, 'kategori' => 'kekerasan'],
        ];
        
        // Ekstraksi sampel dan label dari data latihan
        $samples = [];
        $labels = [];

        foreach ($data as $row) {
            $samples[] = [$row['nilai']];
            $labels[] = $row['kategori'];
        }

        // Membuat instance dari KNearestNeighbors dengan k=3
        $classifier = new KNearestNeighbors($k = 3);

        // Melatih model dengan sampel dan label
        $classifier->train($samples, $labels);

        // Sampel baru yang akan diprediksi
        $newSample = [$text]; // Perhatikan bahwa $text harus berupa array dari fitur-fitur

        // Memprediksi label untuk sampel baru
        $predictedLabel = $classifier->predict($newSample);

        // Mengembalikan label yang diprediksi
        return $predictedLabel;
    }
    // public function knn()
    // {
    //     $samples = [
    //         [0.3],
    //         [0.4],
    //         [0.15],
    //         [0.6],
    //         [0.15],
    //     ];
    //     // $samples = [
    //     //     [3, 5, 6, 7, 4, 7, 3, 4, 7, 9, 5, 5, 8, 3, 4, 2, 2, 6, 8],
    //     //     [3, 6, 6, 3, 1, 3, 2, 4, 8, 4, 2, 3, 7, 4, 8, 4, 9, 4, 7],
    //     //     [2, 6, 2, 4, 2, 7, 8, 6, 5, 3, 3, 7, 6, 6, 6, 3, 8, 4, 7],
    //     //     [6, 6, 4, 5, 5, 4, 6, 7, 7, 4, 3, 6, 4, 4, 6, 3, 4, 7, 5],
    //     //     [3, 5, 3, 6, 3, 7, 4, 8, 2, 3, 3, 2, 3, 2, 3, 3, 7, 8, 5],
    //     // ];

    //     // Label untuk setiap sampel
    //     $labels = ['Pencurian', 'Penipuan', 'Kekerasan', 'Pencurian', 'Kekerasan'];

    //     // Membuat instance KNearestNeighbors dengan k=3
    //     $classifier = new KNearestNeighbors($k = 3);

    //     // Melatih model dengan data dan label
    //     $classifier->train($samples, $labels);

    //     // Data baru yang ingin diprediksi
    //     $newSample = [
    //         [0.10],
    //     ];
    //     // $newSample = [
    //     //     [3, 6, 2, 3, 6, 7, 8, 9, 7, 4, 4, 8, 3, 8, 5, 8, 4, 3, 4],
    //     // ];

    //     // Memprediksi label untuk data baru
    //     $predictedLabel = $classifier->predict($newSample);
    //     dd($predictedLabel);

    // }


}
