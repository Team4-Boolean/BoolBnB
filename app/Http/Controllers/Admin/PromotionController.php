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
use Carbon\Carbon;

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

        // Trovo l'id riferito alla casa selezionata e tutti i suoi dati
        $house = House::findOrFail($data['house_id']);

        $validator = Validator::make($data, [
            'promotion_id' => 'required'
            ]);

        if ($validator->fails()) {
            return redirect()->back()->with('status', 'Campo mancante')
            ->withErrors($validator)
                ->withInput();
        }

        // Trovo l'id della casa che vado a salvare
        $houseId = $house->id;

        // Faccio l'attach della promozione selezionata, con la casa selezionata, per la tabella
        // if(isset($data['promotion_id'])) {
        //     $house->promotions()->attach($data['promotion_id']);
        // }

        // Se la casa ha già una promo attiva, allora lo reindirizzo
        if($house->promotions()->exists($houseId)) {
            abort('403');
        } else {
            $house->promotions()->attach($data['promotion_id']);
        }

        // Trovo la data e l'orario di attivazione della promo (pivot)
        foreach ($house->promotions as $promotion) {
             $activatePromo = $promotion->pivot->created_at;
            }

        // Trovo l'id della promozione selezionata
        $promotion = Promotion::findOrFail($data['promotion_id']);
        $promotionId = $promotion->id;

        // Se l'id della promozione è == ... aggiungi 1/2/3 giorni
        if ($promotionId == 1) {
            $activatePromo->addDays(1);
        } elseif ($promotionId == 2) {
            $activatePromo->addDays(3);
        } elseif ($promotionId == 3) {
            $activatePromo->addDays(6);
        }

        return redirect()->route('admin.promotions.show', $promotion->id)->with( ['activatePromo' => $activatePromo] );;
        // return redirect()->route('payment', compact('promotionId'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);

        return view('admin.promotions.show', compact('promotion'));
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
