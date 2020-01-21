<?php

namespace App\Http\Controllers;

use App\destinatario;
use Illuminate\Http\Request;

class DestinatarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['destinatario'] = destinatario::paginate(10);

        //return response()->json($datos);

        return view('destinatario.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('destinatario.crear');
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
            'Nombre' => 'required|string|max:150',
            'Cargo' => 'required|string|max:150'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosDestinatario */
        //$datosDestinatario = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosDestinatario = request()->except('_token');
       
        /* Recoleccion de la foto 
        if( $request->hasFile('Foto') ){
            $datosDestinatario['Foto']=$request->file('Foto')->store('uploads','public');
        }*/

        destinatario::insert($datosDestinatario);

        //return response()->json($datosDestinatario);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('destinatario')->with('Mensaje','Destinatario agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\destinatario  $destinatario
     * @return \Illuminate\Http\Response
     */
    public function show(destinatario $destinatario)
    {
        //
        return view('destinatario.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\destinatario  $destinatario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // findOrFail() nos da toda la informacion que corresponde a id 
        $destinatario = destinatario::findOrFail($id);

        // compact() crea un conjunto de informacion a traves de una variable
        return view('destinatario.editar', compact('destinatario'));
        
        //return response()->json($destinatario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\destinatario  $destinatario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'Nombre' => 'required|string|max:150',
            'Cargo' => 'required|string|max:150'
        ];

        /*if( $request->hasFile('Foto') ){
            $campos += ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }*/

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);
        
        //
        $datosDestinatario = request()->except(['_token','_method']);
        
        /* Recoleccion de la foto si es que existe en el formulario
        if( $request->hasFile('Foto') ){
            
            $destinatario = destinatario::findOrFail($id);
            $borrar=Storage::delete('public/'. $destinatario->foto);
            
            $datosDestinatario['Foto']=$request->file('Foto')->store('uploads','public');
        }
        */
        destinatario::where('id', "=", $id)->update($datosDestinatario);

        // findOrFail() nos da toda la informacion que corresponde a id 
        //$destinatario = destinatario::findOrFail($id);
        // compact() crea un conjunto de informacion a traves de una variable
        //return view('destinatario.editar', compact('destinatario'));

        return redirect('destinatario')->with('Mensaje','El destinatario fue modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\destinatario  $destinatario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $destinatario = destinatario::findOrFail($id);
        
        /*if(Storage::delete('public/'. $correspondencia->foto)){ 
        }*/

        destinatario::destroy($id);
        
        //return redirect('destinatario');
        return redirect('destinatario')->with('Mensaje','Destinatario eliminado');
    }
}
