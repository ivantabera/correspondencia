<?php

namespace App\Http\Controllers;

use App\bajaTurno;
use App\capturaCorrespondencia;
use App\promoremit;
use App\turnadoccp;
use App\turnadopor;
use App\turno;
use PDF;
use Dompdf\Options;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CapturaCorrespondenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 
        $num_entrada = $request->get('num_entrada');
        $asunto      = $request->get('asunto');
        $referencia  = $request->get('referencia');

        $correspondencia = capturaCorrespondencia::where('status', '=', '1')
        ->where('turnado', '=', '0')
        ->where('baja', '=', '0')
        ->join('promoremits', 'captura_correspondencias.promotor_id', '=', 'promoremits.id')
        ->join('dirigidos', 'captura_correspondencias.dirigido_id', '=', 'dirigidos.id')
        ->select('captura_correspondencias.id', 
                 'captura_correspondencias.num_entrada', 
                 'captura_correspondencias.referencia', 
                 'promoremits.nombre as promotor', 
                 'dirigidos.nombre as dirigido', 
                 'captura_correspondencias.asunto', 
                 'captura_correspondencias.date_acuse', 
                 'captura_correspondencias.foto')
                 ->orderBy('captura_correspondencias.id', 'desc')
        ->nument($num_entrada)
        ->asunto($asunto)
        ->referencia($referencia)
        ->paginate(5);
        
        foreach ($correspondencia as $val) {
            
            $cant = strlen($val['num_entrada']);

            if($cant == 1){
                $val['num_entrada'] = 'SDGM20-000'. $val['num_entrada'];
            } elseif($cant == 2){
                $val['num_entrada'] = 'SDGM20-00'. $val['num_entrada'];
            } elseif($cant == 3){
                $val['num_entrada'] = 'SDGM20-0'. $val['num_entrada'];
            }
        }

        //turnados
        $correspondenciaTurnados = capturaCorrespondencia::where('status', '=', '1')
        ->where('turnado', '=', '1')
        ->where('baja', '=', '0')
        ->join('promoremits', 'captura_correspondencias.promotor_id', '=', 'promoremits.id')
        ->join('dirigidos', 'captura_correspondencias.dirigido_id', '=', 'dirigidos.id')
        ->select('captura_correspondencias.id', 
                 'captura_correspondencias.num_entrada', 
                 'captura_correspondencias.referencia', 
                 'promoremits.nombre as promotor', 
                 'dirigidos.nombre as dirigido', 
                 'captura_correspondencias.asunto', 
                 'captura_correspondencias.date_acuse', 
                 'captura_correspondencias.foto')
                 ->orderBy('captura_correspondencias.id', 'desc')
        ->nument($num_entrada)
        ->asunto($asunto)
        ->referencia($referencia)
        ->paginate(5);
        
        foreach ($correspondenciaTurnados as $val) {
            
            $cant = strlen($val['num_entrada']);

            if($cant == 1){
                $val['num_entrada'] = 'SDGM20-000'. $val['num_entrada'];
            } elseif($cant == 2){
                $val['num_entrada'] = 'SDGM20-00'. $val['num_entrada'];
            } elseif($cant == 3){
                $val['num_entrada'] = 'SDGM20-0'. $val['num_entrada'];
            }
        }

        //turnados
        $correspondenciaTurnadosBaja = capturaCorrespondencia::where('status', '=', '1')
        ->where('turnado', '=', '1')
        ->where('baja', '=', '1')
        ->join('promoremits', 'captura_correspondencias.promotor_id', '=', 'promoremits.id')
        ->join('dirigidos', 'captura_correspondencias.dirigido_id', '=', 'dirigidos.id')
        ->select('captura_correspondencias.id', 
                 'captura_correspondencias.num_entrada', 
                 'captura_correspondencias.referencia', 
                 'promoremits.nombre as promotor', 
                 'dirigidos.nombre as dirigido', 
                 'captura_correspondencias.asunto', 
                 'captura_correspondencias.date_acuse', 
                 'captura_correspondencias.foto')
                 ->orderBy('captura_correspondencias.id', 'desc')
        ->nument($num_entrada)
        ->asunto($asunto)
        ->referencia($referencia)
        ->paginate(5);
        
        foreach ($correspondenciaTurnados as $val) {
            
            $cant = strlen($val['num_entrada']);

            if($cant == 1){
                $val['num_entrada'] = 'SDGM20-000'. $val['num_entrada'];
            } elseif($cant == 2){
                $val['num_entrada'] = 'SDGM20-00'. $val['num_entrada'];
            } elseif($cant == 3){
                $val['num_entrada'] = 'SDGM20-0'. $val['num_entrada'];
            }
        }

        //return response()->json($correspondencia);

        //Alert::success('Success Title', 'Success Message');
        return view('correspondencia.index', compact('correspondencia','correspondenciaTurnados', 'correspondenciaTurnadosBaja'));
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

        //return response()->json($consecutivoNumEntrada);

        return view('correspondencia.crear', [
            'promoremit' => $promoremit,
            'now' => $now,
            'tipodocs' => $tipodocs,
            'dirigidos' => $dirigidos,
            'expedientes' => $expedientes,
            'num_entrada' => $consecutivoNumEntrada
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
        //return response()->json($request);
        //validar si los campos con Fk vienen vacios usar el registro auxiliar
        if($request['remitente_id'] == 0){
            $request['remitente_id'] = 1817;
        }
        if($request['dirigido_id'] == 0){
            $request['dirigido_id'] = 3746;
        }
        if($request['tipo_id'] == 0){
            $request['tipo_id'] = 38;
        }
        if($request['expediente_id'] == 0){
            $request['expediente_id'] = 201;
        }

        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'num_entrada' => 'required|string|max:150',
            'date_acuse' => 'required|string|max:150',
            'hora_acuse' => 'required|string|max:150',
            'date_elaboracion' => 'required|string|max:150',
            /* 'referencia' => 'required|string|max:150', */
            'promotor_id' => 'required|string|max:150',
            /* 'remitente' => 'required|string|max:150', */
            /*'dirigido_id' => 'required|string|max:150',/* 
            'antecedente' => 'required|string|max:150',
            'particular' => 'required|string|max:150', 
            'firmado_por' => 'required|string|max:150',
            'cargo' => 'required|string|max:150',
           'clasificacion' => 'required|string|max:150', */
            'asunto' => 'required|string'/* ,
            'evento' => 'required|string|max:150',
            'date_evento' => 'required|string|max:150',
            'hora_evento' => 'required|string|max:150',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg' */
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosCorrespondencia */
        //$datosCorrespondencia = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosCorrespondencia = request()->except('_token');

        $datosCorrespondencia['user_id'] = auth()->id(); //insertar el usuario que esta registrando
       
        /** Recoleccion de la foto */
        if( $request->hasFile('foto') ){
            $datosCorrespondencia['foto']=$request->file('foto')->store('uploads','public');
        }

        $datosCorrespondencia['created_at'] = \Carbon\Carbon::now();
        $datosCorrespondencia['updated_at'] = \Carbon\Carbon::now();

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
        dd($capturaCorrespondencia->id);
        return view('correspondencia.formulario', compact('capturaCorrespondencia'));
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
            ->join('promoremits', 'captura_correspondencias.promotor_id', '=', 'promoremits.id')
            ->select('promoremits.id', 'promoremits.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();

        $remitente = DB::table('captura_correspondencias')
            ->join('promoremits', 'captura_correspondencias.remitente_id', '=', 'promoremits.id')
            ->select('promoremits.id', 'promoremits.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();
        
        $tipodoc = DB::table('captura_correspondencias')
            ->join('tipodocs', 'captura_correspondencias.tipo_id', '=', 'tipodocs.id')
            ->select('tipodocs.id', 'tipodocs.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();
        
        $dirigido = DB::table('captura_correspondencias')
            ->join('dirigidos', 'captura_correspondencias.dirigido_id', '=', 'dirigidos.id')
            ->select('dirigidos.id', 'dirigidos.nombre')
            ->where('captura_correspondencias.id', '=', $correspondencia->id)
            ->get();
            
        $expedient = DB::table('captura_correspondencias')
            ->join('expedientes', 'captura_correspondencias.expediente_id', '=', 'expedientes.id')
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
        //return response()->json($request);
        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'num_entrada' => 'required|string|max:150',
            'date_acuse' => 'required|string|max:150',
            'hora_acuse' => 'required|string|max:150',
            'date_elaboracion' => 'required|string|max:150',
            /* 'referencia' => 'required|string|max:150', */
            'promotor_id' => 'required|string|max:150',
            /* 'remitente' => 'required|string|max:150', */
            /*'dirigido_id' => 'required|string|max:150',/* 
            'antecedente' => 'required|string|max:150',
            'particular' => 'required|string|max:150', */
            'firmado_por' => 'required|string|max:150',
            'cargo' => 'required|string|max:150',
            /* 'clasificacion' => 'required|string|max:150', */
            'asunto' => 'required|string'/* ,
            'evento' => 'required|string|max:150',
            'date_evento' => 'required|string|max:150',
            'hora_evento' => 'required|string|max:150',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg' */
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

    public function exportpdf($id){

        $correspondencia = capturaCorrespondencia::findOrFail($id);
        $turno = turno::where('folio', '=', $id)->get();
        //return response()->json($turno[0]['turnado_a']);
        $para = turnadoccp::findOrFail($turno[0]['turnado_a']);
        $de = turnadopor::findOrFail($turno[0]['turnado_por']);

        $pdf = PDF::loadView('pdf.correspondencia', [
            'correspondencia'   => $correspondencia,
            'turno'             => $turno[0], 
            'para'              => $para,
            'de'                => $de
        ]);

        return $pdf->download('correspondencia.pdf'); 
    }

    public function status($id)
    {
        //
        //echo json_encode($id);exit;
        $correspondencia = capturaCorrespondencia::findOrFail($id);
        
        
        $correspondencia->status = 0;
        $correspondencia->save();

        $result = capturaCorrespondencia::findOrFail($id);
        
        //return redirect('correspondencia');
        return redirect('correspondencia')->with('Mensaje','Correspondencia eliminada');
    }


    /**
     * Peticion para registrar la baja del documento
     *
     */
    public function ajaxbaja()
    {
        //
        $resp = array('s' => 0, 'm' => ''); 

        $data = array();
        $data = array_merge($data, (array) $_POST);

        $correspondencia = capturaCorrespondencia::find($data['idBaja']);

        if($correspondencia){

            $correspondencia->baja = 1;
            $correspondencia->save();

            $data['created_at'] = \Carbon\Carbon::now();
            $data['updated_at'] = \Carbon\Carbon::now();

            bajaTurno::insert($data);
            
            $resp['s'] = 1;
			$resp['m'] = 'success';
            $resp['correspondencia'] = $correspondencia;
            $resp['data'] = $data;
        }else{
            $resp['s'] = 0;
			$resp['m'] = 'error, no hay registro';
        }

        return response()->json($resp);
    }

}
