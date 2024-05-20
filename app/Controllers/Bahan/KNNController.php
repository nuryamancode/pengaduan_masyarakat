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

    public function knn()
    {
        $samples = [    
            [1],
            [2],
            [3],
            [1],
            [1],
            [2],
        ];
        
        // Label untuk setiap sampel
        $labels = ['Manjab Jua', 'Mantab', 'Mantab Jua', 'Mantab', 'Mantab Jua' ,'Mantab'];
        
        // Membuat instance KNearestNeighbors dengan k=3
        $classifier = new KNearestNeighbors($k=3);
        
        // Melatih model dengan data dan label
        $classifier->train($samples, $labels);
        
        // Data baru yang ingin diprediksi
        $newSample = [
            ['1'],
            ['2'],
        ];
        
        // Memprediksi label untuk data baru
        $predictedLabel = $classifier->predict($newSample);
        dd($predictedLabel);
        
    }
}
