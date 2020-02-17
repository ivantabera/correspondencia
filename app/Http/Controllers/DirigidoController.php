<?php

namespace App\Http\Controllers;

use App\dirigido;
use Illuminate\Http\Request;

class DirigidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //
         $datos['dirigido'] = dirigido::paginate(10);

         //return response()->json($datos);
 
         return view('dirigido.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dirigido.crear');
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
        $datosDirigido = request()->except('_token');

        $datosDirigido['created_at'] = \Carbon\Carbon::now();
        $datosDirigido['updated_at'] = \Carbon\Carbon::now();

        dirigido::insert($datosDirigido);

        //return response()->json($datosDestinatario);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('dirigido')->with('Mensaje','Dirigido agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dirigido  $dirigido
     * @return \Illuminate\Http\Response
     */
    public function show(dirigido $dirigido)
    {
        //
        return view('dirigido.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dirigido  $dirigido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // findOrFail() nos da toda la informacion que corresponde a id 
        $dirigido = dirigido::findOrFail($id);

        // compact() crea un conjunto de informacion a traves de una variable
        return view('dirigido.editar', compact('dirigido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\dirigido  $dirigido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        
        //
        $datosDirigido = request()->except(['_token','_method']);

        dirigido::where('id', "=", $id)->update($datosDirigido);

        return redirect('dirigido')->with('Mensaje','El dirigido fue modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dirigido  $dirigido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //
         $dirigido = dirigido::findOrFail($id);
        
         /*if(Storage::delete('public/'. $correspondencia->foto)){ 
         }*/
 
         dirigido::destroy($id);
         
         //return redirect('destinatario');
         return redirect('dirigido')->with('Mensaje','Dirigido eliminado');
    }
}
