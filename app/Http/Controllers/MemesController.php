<?php

namespace App\Http\Controllers;

use App\Memes;
use Illuminate\Http\Request;

class MemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returnJSON = array();
        $memes = Memes::orderBy('created_at', 'asc')->get();
        foreach ($memes as $meme) {
          $jsonob = [
            'id' => $meme->id,
            'name' => $meme->name,
            'url' => $meme->url,
            'page' => Memes::whichPage($meme->id),
            'requestedCount' => $meme->requestedCount
          ];
          array_push($returnJSON, $jsonob);
        }
        return response()->json($returnJSON);
    }

    public function create()
    {
      return view('add-meme');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Memes::create($request->all());
        return response()->json([
            'name' => $request->name,
            'url' => $request->url
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Memes  $memes
     * @return \Illuminate\Http\Response
     */
    public function show(Memes $memes)
    {
        $memes->incrementViewCount();
        return response()->json([
          'id' => $memes->id,
          'name' => $memes->name,
          'url' => $memes->url,
          'page' => Memes::whichPage($memes->id),
          'requestedCount' => $memes->requestedCount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memes  $memes
     * @return \Illuminate\Http\Response
     */
    public function popular()
    {
          $popular = Memes::where('requestedCount', Memes::max('requestedCount'))->first();
          return response()->json([
            'id' => $popular->id,
            'name' => $popular->name,
            'url' => $popular->url,
            'page' => Memes::whichPage($popular->id),
            'requestedCount' => $popular->requestedCount
          ]);
    }

    public function setByPage($page)
    {
      $returnJSON = array();
      $memes = Memes::byPage($page);
      foreach ($memes as $meme) {
        $jsonob = [
          'id' => $meme->id,
          'name' => $meme->name,
          'url' => $meme->url,
          'page' => Memes::whichPage($meme->id),
          'requestedCount' => $meme->requestedCount
        ];
        array_push($returnJSON, $jsonob);
      }
      return response()->json($returnJSON);
    }
}
