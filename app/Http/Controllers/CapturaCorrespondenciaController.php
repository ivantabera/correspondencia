<?php

namespace App\Http\Controllers;

use App\capturaCorrespondencia;
use Illuminate\Http\Request;

class CapturaCorrespondenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['correspondencia'] = capturaCorrespondencia::paginate(5);

        //return response()->json($datos);

        return view('correspondencia.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('correspondencia.crear');
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
        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosCorrespondencia */
        //$datosCorrespondencia = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosCorrespondencia = request()->except('_token');
       
        /** Recoleccion de la foto */
        if( $request->hasFile('Foto') ){
            $datosCorrespondencia['Foto']=$request->file('Foto')->store('uploads','public');
        }

        capturaCorrespondencia::insert($datosCorrespondencia);

        return response()->json($datosCorrespondencia);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\capturaCorrespondencia  $capturaCorrespondencia
     * @return \Illuminate\Http\Response
     */
    public function show(capturaCorrespondencia $capturaCorrespondencia)
    {
        //
        return view('correspondencia.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\capturaCorrespondencia  $capturaCorrespondencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // findOrFail() nos da toda la informacion que corresponde a id 
        $correspondencia = capturaCorrespondencia::findOrFail($id);

        // compact() crea un conjunto de informacino a traves de una variable
        return view('correspondencia.editar', compact('correspondencia'));
        
        //return response()->json($correspondencia);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\capturaCorrespondencia  $capturaCorrespondencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosCorrespondencia = request()->except(['_token','_method']);

        capturaCorrespondencia::where('id', "=", $id)->update($datosCorrespondencia);

        // findOrFail() nos da toda la informacion que corresponde a id 
        $correspondencia = capturaCorrespondencia::findOrFail($id);

        // compact() crea un conjunto de informacino a traves de una variable
        return view('correspondencia.editar', compact('correspondencia'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\capturaCorrespondencia  $capturaCorrespondencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        capturaCorrespondencia::destroy($id);

        return redirect('correspondencia');
    }
}
