<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Promotion;
use App\House;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Seleziono tutte le categorie
        $promotions = Promotion::all();
        // Seleziono solo le case riferiti a quell'utente
        $houses = House::where('user_id', '=', Auth::id())->get();

        return view('admin.promotions.index', compact('promotions', 'houses'));
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

        // Trovo i dati riferiti alla casa che seleziono
        $house = House::findOrFail($data['house_id']);

        $validator = Validator::make($data, [
            'promotion_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('status', 'Campo mancante')
            ->withErrors($validator)
                ->withInput();
        }

        // Faccio l'attach della promozione selezionata, con la casa selezionata, per la tabella
        if(isset($data['promotion_id'])) {
            $house->promotions()->attach($data['promotion_id']);
        }

        return redirect()->route('payment')->with('status', 'Procedi al pagamento');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
