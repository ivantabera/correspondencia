<?php

namespace App\Http\Controllers;

use App\promoremit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoremitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['promoremit'] = promoremit::paginate(10);

        //return response()->json($datos);
        //echo json_encode($datos);

        return view('promoremit.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('promoremit.crear');
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
            'Alias' => 'required|string|max:191',
            'Nombre' => 'required|string|max:191',
            'Encargado' => 'required|string|max:191',
            'Cargo' => 'required|string|max:191',
            'Tipo' => 'required|string|max:191',
            'Extension' => 'required|string|max:191'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosPromoRemit */
        //$datosPromoRemit = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosPromoRemit = request()->except('_token');
       
        /* Recoleccion de la foto  si es que existe en el formulario
        if( $request->hasFile('Foto') ){
            $datosPromoRemit['Foto']=$request->file('Foto')->store('uploads','public');
        }*/

        $datosPromoRemit['created_at'] = \Carbon\Carbon::now();
        $datosPromoRemit['updated_at'] = \Carbon\Carbon::now();

        promoremit::insert($datosPromoRemit);

        //return response()->json($datosPromoRemit);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('promoremit')->with('Mensaje','Promotor / Remitente agregado/a con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function show(promoremit $promoremit)
    {
        //
        return view('promoremit.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $promoremit = promoremit::findOrFail($id);

        //echo json_encode($promoremit);
        // compact() crea un conjunto de informacino a traves de una variable
        return view('promoremit.editar', compact('promoremit'));
        
        //return response()->json($promoremit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validacion de que los campos vengan llenos con la informacion correspondiente
        $campos =[
            'Alias' => 'required|string|max:191',
            'Nombre' => 'required|string|max:191',
            'Encargado' => 'required|string|max:191',
            'Cargo' => 'required|string|max:191',
            'Tipo' => 'required|string|max:191',
            'Extension' => 'required|string|max:191'
        ];

       /*  Recibir imagen en caso de tener para actualizar
        if( $request->hasFile('Foto') ){
            $campos += ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }*/

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);
        
        //
        $datosPromoRemit = request()->except(['_token','_method']);
        
        /* Recoleccion de la foto en caso de tener alguna
        if( $request->hasFile('Foto') ){
            
            $correspondencia = promoremit::findOrFail($id);
            $borrar=Storage::delete('public/'. $correspondencia->foto);
            var_dump($borrar);
            $datosPromoRemit['Foto']=$request->file('Foto')->store('uploads','public');
        }
        */
        promoremit::where('id', "=", $id)->update($datosPromoRemit);

        // findOrFail() nos da toda la informacion que corresponde a id 
        //$correspondencia = capturaCorrespondencia::findOrFail($id);
        // compact() crea un conjunto de informacion a traves de una variable
        //return view('correspondencia.editar', compact('correspondencia'));

        return redirect('promoremit')->with('Mensaje','Promotor / Remitente modificado/a con éxito');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\promoremit  $promoremit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $promoRemit = promoremit::findOrFail($id);
        
        /* por si hay alguna foto que eliminar
        if(Storage::delete('public/'. $promoRemit->foto)){
        }*/
        promoremit::destroy($id);
        
        //return redirect('promoRemit');
        return redirect('promoremit')->with('Mensaje','Promotor / Remitente eliminado/a con éxito');
    }

    /**
     * Peticion para traer los elementos de un promotor o remitente y rellenar el fomrulario de correspondencia
     *
     */
    public function getajax($id)
    {
        //
        $resp = array('s' => 0, 'm' => ''); 

        $promoremit = promoremit::find($id);

        if($promoremit){
            $resp['s'] = 1;
			$resp['m'] = 'success';
			$resp['promotordata'] = $promoremit;
        }else{
            $resp['s'] = 0;
			$resp['m'] = 'error, no hay registro';
        }

        return response()->json($resp);
    }
}
