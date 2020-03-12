<?php

namespace App\Http\Controllers;

use App\turno;
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
}
