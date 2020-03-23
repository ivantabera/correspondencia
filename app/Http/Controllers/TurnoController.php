<?php

namespace App\Http\Controllers;

use App\turno;
use App\semaforo;
use App\capturaCorrespondencia;
use App\turnadoccp;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view('turno.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexturno($id)
    {
        //
        
        $turno = turno::where('folio', '=', $id) //consulta para mostrar en la vista la informacion de los turnos de correspondencia 
        ->where('status', '=', '1')
        ->join('turnadoccps', 'turnos.turnado_a', '=', 'turnadoccps.id')
        ->join('turnadopors', 'turnos.turnado_por', '=', 'turnadopors.id')
        ->select('turnos.id', 
                 'turnos.oficio', 
                 'turnos.turno_num', 
                 'turnos.fecha_turno', 
                 'turnadoccps.nombre as turnado_a', 
                 'turnos.compromiso_date',
                 'turnadopors.nombre as turnado_por')
        ->orderBy('turnos.turno_num')
        ->paginate(5);

        $contarTurnos =  turno::where('folio', '=', $id) //consulta para validar cuantos turnos hay de esta correspondencia y controlar el sufijo
        ->join('turnadoccps', 'turnos.turnado_a', '=', 'turnadoccps.id')
        ->join('turnadopors', 'turnos.turnado_por', '=', 'turnadopors.id')
        ->select('turnos.oficio', 
                 'turnos.turno_num', 
                 'turnos.fecha_turno', 
                 'turnadoccps.nombre as turnado_a', 
                 'turnos.compromiso_date',
                 'turnadopors.nombre as turnado_por')
        ->count();  

        $folio = $id; //este sirve para enviar el valor para el boton de turno nuevo

        //return response()->json($turno);
        return view('turno.indexturno', compact('turno', 'folio', 'contarTurnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $id = $request['idTurno'];
        $correspondencia = capturaCorrespondencia::findOrFail($id);

            
            $cant = strlen($correspondencia['num_entrada']);

            if($cant == 1){
                $correspondencia['num_entrada'] = 'SDGM20-000'. $correspondencia['num_entrada'];
            } elseif($cant == 2){
                $correspondencia['num_entrada'] = 'SDGM20-00'. $correspondencia['num_entrada'];
            } elseif($cant == 3){
                $correspondencia['num_entrada'] = 'SDGM20-0'. $correspondencia['num_entrada'];
            }

        $now = Carbon::now();
        $turnadoa = DB::table('turnadoccps')->orderBy('turnadoccps.nombre')->get();
        $ccp = DB::table('turnadoccps')->orderBy('turnadoccps.nombre')->get();
        $turnadopor = DB::table('turnadopors')->get();
        $instrucciones = DB::table('instruccions')->get();
        $semaforo = DB::table('semaforos')->get();

        $turno_num = turno::where('folio', '=', $request['idTurno'])->max("turno_num"); //seleccionamos el turno_num maximo 
        $turno_num++; // Sumamos '1' para hacer un consecutivo para crear el nuevo turno

        //return response()->json($turnadoa);

        return view('turno.crear', compact('correspondencia', 'turno_num', 'turnadoa', 'ccp', 'turnadopor', 'instrucciones', 'semaforo', 'now'));
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

        /* $campos =[
            'oficio' => 'required',
            'fecha_turno' => 'required',
            'turnado_a' => 'required',
            'turnado_por' => 'required',
            'instruccion_adicional' => 'required',
            'instruccion' => 'required',
            'semaforo' => 'required',
            'respuesta_auto' => 'required',
            'compromiso_date' => 'required'
        ]; */

        //enviar el mensaje con el atributo si esta erroneo
        //$Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        //$this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosTurno */
        //$datosTurno = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        
        $datosTurno = request()->except('_token');

        //$datosTurno['ccp'] = json_encode($request->ccp);
        $ccpConver = $request->ccp;
        $datosTurno['ccp'] = implode(',', $ccpConver);
        $datosTurno['user_id'] = auth()->id();


        $datosTurno['created_at'] = \Carbon\Carbon::now();
        $datosTurno['updated_at'] = \Carbon\Carbon::now();

        turno::insert($datosTurno);

        //return response()->json($datosTurno);

        //Enviar mensaje a la vista correspondencia ""with"
        $ruta = 'turno/index/'.$request['folio'];
        return redirect($ruta)->with('Mensaje','Turno agregado con éxito');
        //return redirect()->route('turno/index/', [$request['folio']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function show(turno $turno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $turno = turno::findOrFail($id);
        $turnadoa = DB::table('turnadoccps')->orderBy('turnadoccps.nombre')->get();
        $ccp = DB::table('turnadoccps')->orderBy('turnadoccps.nombre')->get();
        $turnadopor = DB::table('turnadopors')->get();
        $instrucciones = DB::table('instruccions')->get();

        $ccpConvArray = explode(",", $turno['ccp']); //se convierte la cadena en arreglo
        
        $now = Carbon::now();

        $turnado_a = DB::table('turnos')
            ->join('turnadoccps', 'turnos.turnado_a', '=', 'turnadoccps.id')
            ->select('turnadoccps.id', 'turnadoccps.nombre')
            ->where('turnos.id', '=', $id)
            ->get();

        $ccpSel = turnadoccp::whereIn('id', $ccpConvArray)
            ->select('id', 'nombre')        
            ->get();

        $turnado_por = DB::table('turnos')
            ->join('turnadopors', 'turnos.turnado_por', '=', 'turnadopors.id')
            ->select('turnadopors.id', 'turnadopors.nombre')
            ->where('turnos.id', '=', $id)
            ->get();

        $instruccion = DB::table('turnos')
            ->join('instruccions', 'turnos.instruccion', '=', 'instruccions.id')
            ->select('instruccions.id', 'instruccions.nombre')
            ->where('turnos.id', '=', $id)
            ->get();

        $semaforo = DB::table('turnos')
            ->join('semaforos', 'turnos.semaforo', '=', 'semaforos.id')
            ->select('semaforos.id', 'semaforos.nombre')
            ->where('turnos.id', '=', $id)
            ->get();

        //return response()->json($turno);

        return view('turno/editar', [
            'turno'             => $turno,
            'turnadoa'          => $turnadoa,
            'turnado_a'         => $turnado_a,
            'ccp'               => $ccp,
            'ccpSel'            => $ccpSel,
            'turnado_por'       => $turnado_por,
            'turnadopor'        => $turnadopor,
            'instrucciones'     => $instrucciones,
            'instruccion'       => $instruccion,
            'semaforo'          => $semaforo,
            'now'               => $now
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $datosTurno = request()->except(['_token','_method']);

        $ccpConver = $request->ccp;
        $datosTurno['ccp'] = implode(',', $ccpConver);
        $datosTurno['user_id'] = auth()->id();

        //return response()->json($datosTurno);
        
        turno::where('id', "=", $id)->update($datosTurno);

        $ruta = 'turno/index/'.$request['folio'];
        return redirect($ruta)->with('Mensaje','Turno modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function destroy(turno $turno)
    {
        //
    }

    public function getajax()
    {
        $resp = array('s' => 0, 'm' => 'error');
		$data = array();
		$data = array_merge($data, (array) $_POST);

        if($data['dias'] != 0){

            // dias a sumar
            $dias = $data['dias'];
            // dias que el programa ha contado
            $dias_contados = 0;
            // timestamp actual
            $time = time();
            // duracion (en segundos) que tiene un día
            $dia_time = 3600*24; //3600 segundos en una hora * 24 horas que tiene un dia.

            function esFestivo($time) {
                $dias_saltados = array(0,6); // 0: domingo, 1: lunes... 6:sabado
                // Guardamos en una variable los dias festivos en varios arrays con formato
                // $dias_festivos[año][mes] = [dias festivos];
                $dias_festivos = array(
                    "2020"=>array(
                        '1'  => [1], 
                        '2'  => [3], 
                        '3'  => [16],
                        '4'  => [9,10],
                        '5'  => [1], 
                        '9'  => [16], 
                        '11' => [16], 
                        '12' => [25]),
                    "2021"=>array(
                        '1'  => [3,4,5,25,31])
                );

                $w = date("w",$time); // dia de la semana en formato 0-6
                if(in_array($w, $dias_saltados)) return true;
                $j = date("j",$time); // dia en formato 1 - 31
                $n = date("n",$time); // mes en formato 1 - 12
                $y = date("Y",$time); // año en formato XXXX
                if(isset($dias_festivos[$y]) && isset($dias_festivos[$y][$n]) && in_array($j,$dias_festivos[$y][$n])) return true;

                return false;
            }
        
            while($dias != 0) {
                $dias_contados++;
                $tiempoContado = $time+($dia_time*$dias_contados); // Sacamos el timestamp en la que estamos ahora mismo comprobando
                if(esFestivo($tiempoContado) == false)
                    $dias--;
            }

            //var_dump( "El programa ha recorrido ".$dias_contados." (ha saltado ".($dias_contados-$dias_origin).") hasta llegar la fecha que deseabas:".PHP_EOL.date("D, d/m/Y",$tiempoContado)); 
            $fechaCompromiso = date("Y-m-d",$tiempoContado);

            $semaforo = semaforo::find($data['semaforo']);

            if($semaforo){
                $resp['s'] = 1;
                $resp['m'] = 'success';
                $resp['semaforodata'] = $semaforo;
                $resp['fechaCompromiso'] = $fechaCompromiso;
            }else{
                $resp['s'] = 0;
                $resp['m'] = 'error, no hay registro';
            }

            return response()->json($resp); 
        }

        $semaforo = semaforo::find($data['semaforo']);
        if($semaforo){
            $resp['s'] = 1;
            $resp['m'] = 'success';
            $resp['semaforodata'] = $semaforo;
            $resp['fechaCompromiso'] = "";
        }else{
            $resp['s'] = 0;
            $resp['m'] = 'error, no hay registro';
        }

        return response()->json($resp); 
    }

    /**
     * Funcion para cambiar el status a los turnos 
     */
    public function status($id)
    {
        //
        //echo json_encode($id);exit;
        $turno = turno::findOrFail($id);
        
        
        $turno->status = 0;
        $turno->save();

        $result = turno::findOrFail($id);
        
        //return response()->json($result);
        $ruta = 'turno/index/'.$result['folio'];
        return redirect($ruta)->with('Mensaje','Turno modificado con éxito');
    }
}
