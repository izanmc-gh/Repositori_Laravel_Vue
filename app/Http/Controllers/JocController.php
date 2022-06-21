<?php

namespace App\Http\Controllers;

use App\Models\Joc;
use Illuminate\Http\Request;

class JocController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            return Joc::all();
        }else{
            return view('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Joc
     */
    public function store(Request $request)
    {
        //dd($request);
        $joc = new Joc();
        $joc->nom=$request->nom;
        $joc->imatge=$request->imatge;
        $joc->num_jug=$request->num_jug;
        $joc->id_Sala=$request->id_Sala;
        //$joc->id_Sala=3;

        $joc->save();

        return $joc;
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
        $data=$request->all();
        /*Recuperem les dades del model*/
        $joc=Joc::find($id);
        /*Actualitzem valors*/
        $joc->nom=$request['nom'];
        $joc->imatge=$request['imatge'];
        $joc->num_jug=$request['num_jug'];
        $joc->id_sala=$request['id_sala'];
        /*Enviem a la base de dades*/
        $joc->save();

        return $joc;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($jocId)
    {
        /*Recuperem les dades del model*/
        $joc=Joc::find($jocId);
        /*Eliminem a la base de dades*/
        $joc->delete();
    }
}
