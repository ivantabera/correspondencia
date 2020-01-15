<?php

namespace App\Http\Controllers;

use App\capturaCorrespondencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'Referencia' => 'required|string|max:150',
            'Promotor' => 'required|string|max:150',
            'Remitente' => 'required|string|max:150',
            'Dirigido' => 'required|string|max:150',
            'Particular' => 'required|string|max:150',
            'Asunto' => 'required|string|max:150',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosCorrespondencia */
        //$datosCorrespondencia = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosCorrespondencia = request()->except('_token');
       
        /** Recoleccion de la foto */
        if( $request->hasFile('Foto') ){
            $datosCorrespondencia['Foto']=$request->file('Foto')->store('uploads','public');
        }

        capturaCorrespondencia::insert($datosCorrespondencia);

        //return response()->json($datosCorrespondencia);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('correspondencia')->with('Mensaje','Correspondencia agregada con éxito');
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

        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'Referencia' => 'required|string|max:150',
            'Promotor' => 'required|string|max:150',
            'Remitente' => 'required|string|max:150',
            'Dirigido' => 'required|string|max:150',
            'Particular' => 'required|string|max:150',
            'Asunto' => 'required|string|max:150'
        ];

        if( $request->hasFile('Foto') ){
            $campos += ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);
        
        //
        $datosCorrespondencia = request()->except(['_token','_method']);
        
        /** Recoleccion de la foto */
        if( $request->hasFile('Foto') ){
            
            $correspondencia = capturaCorrespondencia::findOrFail($id);
            $borrar=Storage::delete('public/'. $correspondencia->foto);
            var_dump($borrar);
            $datosCorrespondencia['Foto']=$request->file('Foto')->store('uploads','public');
        }
        capturaCorrespondencia::where('id', "=", $id)->update($datosCorrespondencia);

        // findOrFail() nos da toda la informacion que corresponde a id 
        //$correspondencia = capturaCorrespondencia::findOrFail($id);
        // compact() crea un conjunto de informacion a traves de una variable
        //return view('correspondencia.editar', compact('correspondencia'));

        return redirect('correspondencia')->with('Mensaje','La correspondencia con referencia modificada con éxito');
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
        $correspondencia = capturaCorrespondencia::findOrFail($id);
        
        if(Storage::delete('public/'. $correspondencia->foto)){
            capturaCorrespondencia::destroy($id);
        }
        
        //return redirect('correspondencia');
        return redirect('correspondencia')->with('Mensaje','Correspondencia eliminada');
    }
}
