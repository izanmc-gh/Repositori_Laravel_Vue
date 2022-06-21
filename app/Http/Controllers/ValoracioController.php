<?php

namespace App\Http\Controllers;

use App\Models\Valoracio;
use Illuminate\Http\Request;

class ValoracioController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Valoracio::all();
        }else{
            return view('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Valoracio
     */
    public function store(Request $request)
    {
        $valoracio = new Valoracio();
        $valoracio->puntuacio = $request['puntuacio'];
        $valoracio->opinio = $request['opinio'];
        $valoracio->save();

        return $valoracio;
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
        $valoracio=Valoracio::find($id);
        /*Actualitzem valors*/
        $valoracio->puntuacio = $request['puntuacio'];
        $valoracio->opinio = $request['opinio'];
        /*Enviem a la base de dades*/
        $valoracio->save();

        return $valoracio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($valoracioId)
    {
        /*Recuperem les dades del model*/
        $valoracio=Valoracio::find($valoracioId);
        /*Eliminem a la base de dades*/
        $valoracio->delete();
    }
}
