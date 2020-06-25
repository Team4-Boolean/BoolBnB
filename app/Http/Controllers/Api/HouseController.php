<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function getHouse($lat,$log)
    {

        // $houses = House::where('latitude' , '=', 46)->get();
        $houses = House::where('latitude' , '=', $lat)->where('longitude', '=', $log)->get();

        return response()->json([
            'result' => 'success',
            'data' => $houses,
            'count' => $houses->count()
        ]);
    }

}
