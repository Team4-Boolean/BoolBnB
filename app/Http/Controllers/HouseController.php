<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\House;
use App\Promotion;
use App\Visitor;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::orderBy('price', 'DESC')->limit(6)->get();

        // $houses = House::all();
        // $promotions = Promotion::all();
        return view('guest.index',compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data['latitude']);
        // Str::of(($data['longitude'],$data['latitude'])->slug('-');

        $lat = $data['latitude'];
        $log = $data['longitude'];
        $radius = 20;

        return redirect()->route('search.index',compact('lat','log','radius'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $house = House::findOrFail($id);

        // Salvo nel DB l'ip dei vistatori
       $user_activity = new Visitor;
       $user_activity->ip_address=$request->ip();
       $user_activity->house_id= $house->id;
       $user_activity->save();

        return view('guest.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
