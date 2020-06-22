<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Message;
use App\House;
use App\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    // Trovo il collegamento tra creatori delle case e utente loggato
    $houses = House::where('user_id', Auth::id())->get();
    // Creo un array per pusshare dentro i miei id
    $houseId = [];

    foreach ($houses as $house) {
        $houseId[] = $house['id'];
     // array_push($houseId, $house['id']);
    }

    $messages = Message::whereIn('house_id', $houseId)->get();


    return view('admin.messages.index', compact('messages'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.messages.show', compact('message'));
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
        $message = Message::findOrFail($id);

        // Controllo aggiuntivo per cancellazione messaggio
        $user = Auth::id();
        $my = $message->house->user_id;
        if ($user != $my) {
            // abort('404');
            return back()->with('status', 'Non puoi cancellare la pagina');
        }
        $delete = $message->delete();

        return redirect()->back()->with('status', 'Messaggio cancellato correttamente');
    }
}
