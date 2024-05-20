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
        $classifier = new KNearestNeighbors($k = 4);
        $classifier = new KNearestNeighbors($k = 3, new Minkowski($lambda = 4));
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);
        $result = $classifier->predict([[3, 4], [1, 5]]);
        dd($result);

        $classifier->predict([[3, 2], [1, 5]]);
        dd(['b', 'a']);
    }
}
