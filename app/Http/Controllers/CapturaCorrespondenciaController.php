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
        $tipodocs = DB::table('tipodocs')->get();
        $dirigidos = DB::table('dirigidos')->get();
        $expedientes = DB::table('expedientes')->get();


        //consecutivo para el numero de entrada
        $consecutivoNumEntrada = DB::table('captura_correspondencias as cc')
            ->max('cc.num_entrada');
        $consecutivoNumEntrada ++;

        return view('correspondencia.crear', [
            'promoremit' => $promoremit,
            'now' => $now,
            'tipodocs' => $tipodocs,
            'dirigidos' => $dirigidos,
            'expedientes' => $expedientes,
            'consecutivo' => $consecutivoNumEntrada
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
            'num_entrada' => 'required|string|max:150',
            'date_acuse' => 'required|string|max:150',
            'hora_acuse' => 'required|string|max:150',
            'date_elaboracion' => 'required|string|max:150',
            'referencia' => 'required|string|max:150',
            'promotor' => 'required|string|max:150',
            'remitente' => 'required|string|max:150',
            'dirigido' => 'required|string|max:150',
            'antecedente' => 'required|string|max:150',
            'particular' => 'required|string|max:150',
            'firmado_por' => 'required|string|max:150',
            'cargo' => 'required|string|max:150',
            'tipo' => 'required|string|max:150',
            'expediente' => 'required|string|max:150',
            'clasificacion' => 'required|string|max:150',
            'asunto' => 'required|string|max:150',
            'evento' => 'required|string|max:150',
            'date_evento' => 'required|string|max:150',
            'hora_evento' => 'required|string|max:150',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg'
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
        if( $request->hasFile('foto') ){
            $datosCorrespondencia['foto']=$request->file('foto')->store('uploads','public');
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
        $tipodocs = DB::table('tipodocs')->get();
        $dirigidos = DB::table('dirigidos')->get();
        $expedientes = DB::table('expedientes')->get();

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
        
        $tipodoc = DB::table('captura_correspondencias')
            ->join('tipodocs', 'captura_correspondencias.tipo', '=', 'tipodocs.id')
            ->select('tipodocs.id', 'tipodocs.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();
        
        $dirigido = DB::table('captura_correspondencias')
            ->join('dirigidos', 'captura_correspondencias.dirigido', '=', 'dirigidos.id')
            ->select('dirigidos.id', 'dirigidos.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();
            
        $expedient = DB::table('captura_correspondencias')
            ->join('expedientes', 'captura_correspondencias.expediente', '=', 'expedientes.id')
            ->select('expedientes.id', 'expedientes.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();
            
        $now = Carbon::now();

        //echo json_encode($expediente);exit;
        
        return view('correspondencia.editar', [
            'correspondencia' => $correspondencia,
            'promoremit' => $promoremit,
            'tipodocs' => $tipodocs,
            'dirigidos' => $dirigidos,
            'expedientes' => $expedientes,
            'promotor' => $promotor,
            'remitente' => $remitente,
            'tipodoc' => $tipodoc,
            'dirigido' => $dirigido,
            'expedient' => $expedient,
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
            'num_entrada' => 'required|string|max:150',
            'referencia' => 'required|string|max:150',
            'promotor' => 'required|string|max:150',
            'remitente' => 'required|string|max:150',
            'dirigido' => 'required|string|max:150',
            'antecedente' => 'required|string|max:150',
            'particular' => 'required|string|max:150',
            'firmado_por' => 'required|string|max:150',
            'cargo' => 'required|string|max:150',
            'tipo' => 'required|string|max:150',
            'expediente' => 'required|string|max:150',
            'clasificacion' => 'required|string|max:150',
            'asunto' => 'required|string|max:150',
            'evento' => 'required|string|max:150'
        ];

        if( $request->hasFile('foto') ){
            $campos += ['foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);
        
        //
        $datosCorrespondencia = request()->except(['_token','_method']);
        
        /** Recoleccion de la foto */
        if( $request->hasFile('foto') ){
            
            $correspondencia = capturaCorrespondencia::findOrFail($id);
            $borrar=Storage::delete('public/'. $correspondencia->foto);
            //var_dump($borrar);
            $datosCorrespondencia['foto']=$request->file('foto')->store('uploads','public');
        }

        //echo json_encode($datosCorrespondencia);exit;
        
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
