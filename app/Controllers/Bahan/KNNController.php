<?php

namespace App\Controllers\Bahan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Math\Distance\Minkowski;

class KNNController extends BaseController
{
    public function index()
    {
        //
    }

    public function search()
    {
        $samples = [    
            [5, 6, 7, 4, 7, 3, 6, 7, 9, 5, 5, 8, 3, 4, 2, 2, 6, 8],
            [6, 6, 3, 1, 3, 2, 2, 4, 8, 4, 2, 3, 7, 4, 4, 9, 4, 7],
            [6, 2, 4, 2, 7, 8, 6, 5, 3, 3, 3, 7, 6, 3, 3, 8, 4, 7],
            [6, 4, 5, 5, 4, 6, 7, 7, 4, 4, 3, 6, 4, 3, 3, 7, 4, 5],
            [5, 3, 6, 3, 7, 4, 4, 3, 2, 3, 4, 3, 7, 3, 7, 8, 2, 5],
            [9, 7, 2, 2, 2, 3, 3, 3, 3, 4, 3, 5, 6, 3, 7, 8, 2, 5],
            [1, 2, 4, 6, 7, 9, 9, 5, 3, 4, 4, 5, 4, 2, 4, 4, 4, 4],
            [3, 8, 2, 4, 3, 6, 8, 7, 3, 3, 3, 6, 3, 4, 7, 9, 3, 7],
            [6, 6, 4, 3, 5, 4, 4, 4, 2, 3, 4, 2, 6, 3, 5, 7, 4, 5],
            [2, 2, 8, 2, 4, 4, 6, 4, 2, 4, 2, 4, 3, 4, 8, 9, 8, 5]
        ];
        
        // Label untuk setiap sampel
        $labels = ['kekerasan', 'pencurian', 'kekerasan', 'kekerasan', 'penipuan', 'penipuan', 'kekerasan', 'pencurian', 'kekerasan', 'penipuan'];
        
        // Membuat instance KNearestNeighbors dengan k=3
        $classifier = new KNearestNeighbors($k=3);
        
        // Melatih model dengan data dan label
        $classifier->train($samples, $labels);
        
        // Data baru yang ingin diprediksi
        $newSample = [6, 2, 3, 6, 7, 8, 9, 7, 4, 4, 8, 5, 8, 4, 3, 4];
        
        // Memprediksi label untuk data baru
        $predictedLabel = $classifier->predict($newSample);
        
        echo "Predicted label for the new sample is: " . $predictedLabel . "\n";
        
    }
}
