<?php

namespace App\Http\Controllers;

use App\capturaCorrespondencia;
use App\promoremit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
 
        //pruebas
        /* $corespondencia = DB::table('captura_correspondencias')->get();
        $users = DB::table('captura_correspondencias')->select('referencia', 'promotor as promo','remitente as hola')->get();
        //echo json_encode($users);
        return view('correspondencia.prueba', [
            'users' => $users,
            'correspondencia' => $corespondencia
            ]); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $promoremit = DB::table('promoremits')->get();
        $now = Carbon::now();

        return view('correspondencia.crear', [
            'promoremit' => $promoremit,
            'now' => $now
        ]);
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

        //echo json_encode($datosCorrespondencia); exit;

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
        $promoremit = DB::table('promoremits')->get();

        $promotor = DB::table('captura_correspondencias')
            ->join('promoremits', 'captura_correspondencias.promotor', '=', 'promoremits.id')
            ->select('promoremits.id', 'promoremits.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();

        $remitente = DB::table('captura_correspondencias')
            ->join('promoremits', 'captura_correspondencias.remitente', '=', 'promoremits.id')
            ->select('promoremits.id', 'promoremits.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();
            
        $now = Carbon::now();

        //echo json_encode($correspondencia);exit;
        
        return view('correspondencia.editar', [
            'correspondencia' => $correspondencia,
            'promoremit' => $promoremit,
            'promotor' => $promotor,
            'remitente' => $remitente,
            'now' => $now
        ]);

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
            //var_dump($borrar);
            $datosCorrespondencia['Foto']=$request->file('Foto')->store('uploads','public');
        }
        
        capturaCorrespondencia::where('id', "=", $id)->update($datosCorrespondencia);

        // findOrFail() nos da toda la informacion que corresponde a id 
        //$correspondencia = capturaCorrespondencia::findOrFail($id);
        // compact() crea un conjunto de informacion a traves de una variable
        //return view('correspondencia.editar', compact('correspondencia'));

        return redirect('correspondencia')->with('Mensaje','La correspondencia fue modificada con éxito');
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
