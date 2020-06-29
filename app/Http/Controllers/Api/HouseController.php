<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\House;
use App\Service;

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

    public function getHouse($lat,$log,$radius)
    {

        $circle_radius = 6371;
        $houses = DB::select(DB::raw('SELECT *, ( '. $circle_radius .' * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $log . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM houses WHERE visible=1 HAVING distance < ' . $radius . ' ORDER BY distance') );
        ;

        // foreach ($houses as $key => $house) {
        //     dd($house->services);
        //     $house['services'] = $house->services;
        // };

        return response()->json([
            'result' => 'success',
            'data' => $houses,

            // 'count' => $houses->count()
        ]);
    }

}
