<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Sala::all();
        }else{
            return view('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Sala
     */
    public function store(Request $request)
    {
        $sala = new Sala();
        $sala->nomSala = $request['nomSala'];
        $sala->capacitat = $request['capacitat'];
        $sala->ocupada = false;
        $sala->save();

        return $sala;
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
        $sala=Sala::find($id);
        /*Actualitzem valors*/
        $sala->nomSala = $request['nomSala'];
        $sala->capacitat = $request['capacitat'];
        $sala->ocupada = false;
        /*Enviem a la base de dades*/
        $sala->save();

        return $sala;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($salaId)
    {
        /*Recuperem les dades del model*/
        $sala=Sala::find($salaId);
        /*Eliminem a la base de dades*/
        $sala->delete();
    }
}
