<?php

namespace App\Http\Controllers;

use App\expediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['expediente'] = expediente::paginate(10);

        //return response()->json($datos);

        return view('expediente.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('expediente.crear');
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
            'Prefijo' => 'required|string|max:150',
            'Nombre' => 'required|string|max:150'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosExpediente */
        //$datosExpediente = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosExpediente = request()->except('_token');
       
        /* Recoleccion de la foto 
        if( $request->hasFile('Foto') ){
            $datosExpediente['Foto']=$request->file('Foto')->store('uploads','public');
        }*/

        expediente::insert($datosExpediente);

        //return response()->json($datosExpediente);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('expedientes')->with('Mensaje','Expediente agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(expediente $expediente)
    {
        //
        return view('expediente.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // findOrFail() nos da toda la informacion que corresponde a id 
        $expediente = expediente::findOrFail($id);

        // compact() crea un conjunto de informacion a traves de una variable
        return view('expediente.editar', compact('expediente'));
        
        //return response()->json($expediente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'Prefijo' => 'required|string|max:150',
            'Nombre' => 'required|string|max:150'
        ];

        /*if( $request->hasFile('Foto') ){
            $campos += ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }*/

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);
        
        //
        $datosExpediente = request()->except(['_token','_method']);
        
        /* Recoleccion de la foto si es que existe en el formulario
        if( $request->hasFile('Foto') ){
            
            $expediente = expediente::findOrFail($id);
            $borrar=Storage::delete('public/'. $expediente->foto);
            
            $datosExpediente['Foto']=$request->file('Foto')->store('uploads','public');
        }
        */
        expediente::where('id', "=", $id)->update($datosExpediente);

        // findOrFail() nos da toda la informacion que corresponde a id 
        //$expediente = expediente::findOrFail($id);
        // compact() crea un conjunto de informacion a traves de una variable
        //return view('expediente.editar', compact('expediente'));

        return redirect('expedientes')->with('Mensaje','El expediente fue modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $expediente = expediente::findOrFail($id);
        
        /*if(Storage::delete('public/'. $expediente->foto)){ 
        }*/

        expediente::destroy($id);
        
        //return redirect('expediente');
        return redirect('expedientes')->with('Mensaje','Expediente eliminado');
    }
}
