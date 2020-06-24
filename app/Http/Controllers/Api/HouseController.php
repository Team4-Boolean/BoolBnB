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
            'data' => $houses
        ]);
    }

    /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
    public function getHouse($id)
    {
        $houses = House::where('id' , '=', $id)->get();
        return response()->json([
            'result' => 'success',
            'data' => $houses
        ]);
    }
}
