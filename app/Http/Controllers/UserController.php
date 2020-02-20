<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['usuario'] = User::paginate(10);

        //return response()->json($datos);

        return view('user.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.crear');
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
            'Nombre' => 'required|string|max:191',
            'Email' => 'required|string|max:191',
            'Password' => 'required|string|max:191'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosUser */
        //$datosUser = request()->all();

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosUser = request()->except('_token');
       
        /* Recoleccion de la foto  si es que existe en el formulario
        if( $request->hasFile('Foto') ){
            $datosUser['Foto']=$request->file('Foto')->store('uploads','public');
        }*/

        $datosUser['created_at'] = \Carbon\Carbon::now();
        $datosUser['updated_at'] = \Carbon\Carbon::now();

        User::insert($datosUser);

        //return response()->json($datosUser);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('user')->with('Mensaje','Usuario registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('user.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::get();
        $permisos = Permission::get();

        //return response()->json($user);
        // compact() crea un conjunto de informacino a traves de una variable
        return view('user.editar', compact('user','roles','permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user, $id)
    {
        //Actualizamos el usuario sin el token ni el metodo
        $datosUsuario = request()->except(['_token','_method', 'roles']);
        
        //Actualizamos el usuario
        User::where('id', "=", $id)->update($datosUsuario);

        $user = User::findOrFail($id);
        $user->roles()->sync($request->get('roles'));
        
        //return response()->json($respuesta);

        return redirect('users')->with('Mensaje','Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario = User::findOrFail($id);
        
        User::destroy($id);
        
        //return redirect('promoRemit');
        return redirect('users')->with('Mensaje','Usuario eliminado con éxito');
    }
}
