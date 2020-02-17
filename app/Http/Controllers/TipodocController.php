<?php

namespace App\Http\Controllers;

use App\tipodoc;
use Illuminate\Http\Request;

class TipodocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['tipodocumento'] = tipodoc::paginate(10);

        //return response()->json($datos);
        //echo json_encode($datos);

        return view('tipodocumento.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tipodocumento.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'Nombre' => 'required|string|max:191'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosTipoDocumento = request()->except('_token');

        $datosTipoDocumento['created_at'] = \Carbon\Carbon::now();
        $datosTipoDocumento['updated_at'] = \Carbon\Carbon::now();

        tipodoc::insert($datosTipoDocumento);

        //return response()->json($datosPromoRemit);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('tipodocumento')->with('Mensaje','Tipo de documento agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipodoc  $tipodoc
     * @return \Illuminate\Http\Response
     */
    public function show(tipodoc $tipodoc)
    {
        //
        return view('tipodocumento.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipodoc  $tipodoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tipodocumento = tipodoc::findOrFail($id);

        return view('tipodocumento.editar', compact('tipodocumento'));
        
        //return response()->json($promoremit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipodoc  $tipodoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'Nombre' => 'required|string|max:191'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);
        
        $tipoDocumento = request()->except(['_token','_method']);
        tipodoc::where('id', "=", $id)->update($tipoDocumento);

        return redirect('tipodocumento')->with('Mensaje','Tipo de documento modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipodoc  $tipodoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        tipodoc::findOrFail($id);
        
        /* por si hay alguna foto que eliminar
        if(Storage::delete('public/'. $promoRemit->foto)){
        }*/
        tipodoc::destroy($id);
        
        //return redirect('promoRemit');
        return redirect('tipodocumento')->with('Mensaje','Tipo de documento eliminado con éxito');
    }
}
