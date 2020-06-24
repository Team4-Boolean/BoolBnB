<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\House;

class HouseController extends Controller
{
    public function getAll()
    {
        $houses = House::all();

        return response()->json([
            'result' => 'success',
            'data' => $houses,
            'count' => $houses->count()
        ]);
    }

}
