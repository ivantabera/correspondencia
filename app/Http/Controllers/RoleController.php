<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['roles'] = Role::paginate(10);

        //return response()->json($datos);

        return view('roles.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $permisos = Permission::get();

        return view('roles.crear', compact('roles','permisos'));
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
            'name' => 'required|string|max:191',
            'slug' => 'required|string|max:191',
            'description' => 'required|string|max:191'
        ];

        //enviar el mensaje con el atributo si esta erroneo
        $Mensaje = ["required" => 'El campo :attribute es requerido'];
        //metodo validate para enviar los errores a la vista
        $this->validate($request, $campos, $Mensaje);

        /** Se almacene todo lo que se envia al metodo storage en la variable  $datosUser */
        //$datosUser = request()->all();
        

        /** Al recabar la informacion evitar que el campo token se inserte en la BD */
        $datosRoles = request()->except('_token','permisos');

        $datosRoles['created_at'] = \Carbon\Carbon::now();
        $datosRoles['updated_at'] = \Carbon\Carbon::now();

        $permisos = $request->get('permisos');

        //Insertamos los roles 
        Role::insert($datosRoles);
        //consultamos todos los roles 
        $role= Role::all();
        //seleccionamos el ultimo rol para desingarle permisos 
        $role->last()->permissions()->sync($permisos);

        //Enviar mensaje a la vista correspondencia ""with"
        return redirect('roles')->with('Mensaje','Rol registrado con éxito');
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
        return view('roles.formulario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //roles
        $roles = Role::findOrFail($id);
        $rol = Role::get();
        //permisos
        $permisos = Permission::get();
        $permiso = Permission::findOrFail($id);

        /*Validar que permisos tiene el rol
        foreach($permisos as $permission){
            echo json_encode($rol->permissions->contains($permission->id));
        } */

        //return response()->json();
        // compact() crea un conjunto de informacino a traves de una variable
        return view('roles.editar', compact('rol','roles', 'permisos', 'permiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Actualizamos el usuario sin el token ni el metodo
        $datosRol = request()->except(['_token','_method', 'permisos']);

        //actualizamos Rol
        Role::where('id', "=", $id)->update($datosRol);

        //actualizamos permisos
        $rol = Role::findOrFail($id);
        $rol->permissions()->sync($request->get('permisos'));
        
        return redirect('roles')->with('Mensaje','Rol actualizado con éxito');
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
        $usuario = Role::findOrFail($id);
        
        Role::destroy($id);
        
        //return redirect('promoRemit');
        return redirect('roles')->with('Mensaje','Rol eliminado con éxito');
    }
}
