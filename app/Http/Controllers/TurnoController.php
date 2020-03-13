<?php

namespace App\Http\Controllers;

use App\turno;
use App\semaforo;
use App\capturaCorrespondencia;
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $id = $request['idCorrespondencia'];
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
        $turnadoa = DB::table('turnadoccps')->get();
        $ccp = DB::table('turnadoccps')->get();
        $turnadopor = DB::table('turnadopors')->get();
        $instrucciones = DB::table('instruccions')->get();
        $semaforo = DB::table('semaforos')->get();

        return view('turno.crear', compact('correspondencia', 'turnadoa', 'ccp', 'turnadopor', 'instrucciones', 'semaforo', 'now'));
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

        $datosTurno['ccp'] = json_encode($request->ccp);
        $datosTurno['user_id'] = auth()->id();


        $datosTurno['created_at'] = \Carbon\Carbon::now();
        $datosTurno['updated_at'] = \Carbon\Carbon::now();

        //echo json_encode($datosTurno); exit;

        turno::insert($datosTurno);

        //return response()->json($datosTurno);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('correspondencia')->with('Mensaje','Turno agregado con éxito');
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, turno $turno)
    {
        //
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
            $fechaCompromiso = date("d/m/Y",$tiempoContado);

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
}
