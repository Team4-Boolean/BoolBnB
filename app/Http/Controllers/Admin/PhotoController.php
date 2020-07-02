<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Photo;
use App\House;
use App\User;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $houses = House::all();

        $houses = House::where('user_id', '=', Auth::id())->get();
        $photos = Photo::all();



        return view('admin.photos.index',compact('houses','photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $houses = House::where('user_id', Auth::id())->get();
        return view('admin.photos.create', compact('houses'));
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
        $validator = Validator::make($data, [
            'house_id' => 'required',
            'name' => 'required|string',
            'description' => 'required',
            'path' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('status', 'Campo mancante')
            ->withErrors($validator)
                ->withInput();
        }
        $path = Storage::disk('public')->put('images', $data['path']);
        $data['path'] = $path;
        $photo = new Photo;
        $photo->fill($data);
        $saved = $photo->save();

        if(!$saved) {
            abort('404');
        }

        return redirect()->route('admin.photos.show', $photo->house_id)->with('status', 'Foto pubblicata con successo');

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
        $photos = Photo::where('house_id', $id)->get();

        return view('admin.photos.show', compact('house', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.photos.edit', compact('photo'));
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
        $photo = Photo::findOrFail($id);
        $validator = Validator::make($data, [
            // 'house_id' => 'required',
            'name' => 'required|string',
            'description' => 'required',
            'path' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('status', 'Campo mancante')
            ->withErrors($validator)
                ->withInput();
        }

        if (isset($data['path'])) {
            Storage::disk('public')->delete($data['path']);

        }
        $path = Storage::disk('public')->put('images', $data['path']);
        $data['path'] = $path;
        $photo->fill($data);
        $updated = $photo->update();

        if(!$updated) {
            abort('404');
        }

        return redirect()->route('admin.photos.show', $photo->house_id)->with('status', 'Foto modificata con successo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        Storage::disk('public')->delete($photo['path']);
        // $photo->house()->delete();
        $deleted = $photo->delete();

        return redirect()->back()->with('status', 'Foto  cancellata con successo');
    }
}
