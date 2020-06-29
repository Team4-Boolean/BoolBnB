<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\House;
use App\Promotion;
use App\Service;
use App\User;
use App\Photo;
use App\Message;
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
        $houses = House::where('user_id', '=', Auth::id())->paginate(6);
        // \Auth::user()

        return view('admin.houses.index',compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.houses.create', compact('services'));
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

        if(!isset($data['visible'])) {
            $data['visible'] = 0;
        } else {
            $data['visible'] = 1;
        }
        if (isset($data['photo'])) {
            $imgcopertina = Storage::disk('public')->put('images', $data['photo']);
            $data['photo'] = $imgcopertina;
        }
        $data['user_id'] = Auth::id();
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'rooms' => 'required',
            'beds' => 'required',
            'photo' => 'required',
            'bathrooms' => 'required',
            'mq' => 'required',
            'address' => 'required',
            'services' => 'required|array',
            'services.*' => 'exists:services,id'
        ]);



        if ($validator->fails()) {
            return redirect()->back()->with('status', 'Campo mancante')
            ->withErrors($validator)
                ->withInput();
        }

        $house = new House;
        $house->fill($data);
        $saved = $house->save();

        if(!$saved) {
            abort('404');
        }

        if(isset($data['services'])) {
            $house->services()->attach($data['services']);
        }


        return redirect()->route('admin.houses.index')->with('status', 'Annuncio pubblicato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house = House::findOrFail($id);

        // Quanti messaggi mi sono arrivati in questo annuncio?
        $message = Message::where('house_id', $id)->count();
        // Quanti utenti hanno visto questo mio annuncio?
        $visitor = Visitor::where('house_id', $id)->count();

        return view('admin.houses.show', compact('house', 'message', 'visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::findOrFail($id);
        $services = Service::all();
        return view('admin.houses.edit', compact('house', 'services'));
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
        $data = $request->all();
        $house = House::findOrFail($id);

        if(!isset($data['visible'])) {
            $data['visible'] = 0;
        } else {
            $data['visible'] = 1;
        }
        if (isset($data['photo'])) {
            Storage::disk('public')->delete($data['photo']);
            $imgcopertina = Storage::disk('public')->put('images', $data['photo']);
            $data['photo'] = $imgcopertina;
        }
        $data['user_id'] = Auth::id();
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'rooms' => 'required',
            'beds' => 'required',
            'photo' => 'required',
            'bathrooms' => 'required',
            'mq' => 'required',
            'address' => 'required',
            'services' => 'required|array',
            'services.*' => 'exists:services,id'
        ]);



        if ($validator->fails()) {
            return redirect()->back()->with('status', 'Campo mancante')
            ->withErrors($validator)
                ->withInput();
        }

        $house->fill($data);
        $update = $house->update();

        if(!$update) {
            abort('404');
        }

        $house->services()->sync($data['services']);

        return redirect()->route('admin.houses.show', $house->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::findOrFail($id);

        $house->services()->detach();
        // Utilizzato per la manytomany
        $house->photos()->delete();

        // Togli le promo riferite alla casa che andrò ad eliminare
        $house->services()->detach();
        // Cancella i messaggi di questa casa che andrò ad eliminare
        $house->messages()->delete();
        // Cancella i visitatori di quella casa
        $house->visitors()->delete();
        // Cancella le promo per quella casa
        $house->promotions()->detach();
        // Cancella la mia casa
        $deleted = $house->delete();

        return redirect()->back()->with('status', 'Annuncio cancellato con successo');
    }


    public function promotions($id)
    {
        $house = House::findOrFail($id);
        $promotions = Promotion::all();

        return view('admin.houses.promotions', compact('house', 'promotions'));
    }
}
