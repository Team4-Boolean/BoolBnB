<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\House;
use App\Promotion;
use App\Service;

class SearchController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lat = $_GET['lat'];
        $log = $_GET['log'];
        $circle_radius = 6371;
        $radius = $_GET['radius'];

        // $lat = 43.0911;
        // $log = 12.44;
        // $circle_radius = 6371;
        // $radius = 20;

        $services = Service::all();

        $houses = DB::select(DB::raw('SELECT *, ( '. $circle_radius .' * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $log . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM houses WHERE visible=1 HAVING distance < ' . $radius . ' ORDER BY distance') );

        // foreach ($houses as $key => $house) {
        //     foreach ($house->services as $key => $service) {
        //         dd($service);
        //         $house['services'] = $house->services;
        //     }
        //
        // };

        $promotions = Promotion::orderBy('price', 'DESC')->get();
        foreach ($promotions as $key => $promotion) {
            $sponsoredHouses= $promotion->houses()->where('visible', '1')->limit(8)->get();
        };

        return view('guest.search',compact('houses','sponsoredHouses','services'));
    }

}
