<?php

use Caffeinated\Shinobi\Contracts\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Usuarios
        DB::table('permissions')->insert([
            'name'          => 'Navegar correspondencia',
            'slug'          => 'correspondencia.index',
            'description'   => 'Lista toda la correspondencia del sistema',
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Ver pdf de correspondencia',
            'slug'          => 'correspondencia.pdf',
            'description'   => 'PDF de toda la correspondencia del sistema',
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Editar correspondencia',
            'slug'          => 'correspondencia.edit',
            'description'   => 'Editar toda la correspondencia del sistema',
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Eliminar roles',
            'slug'          => 'correspondencia.destroy',
            'description'   => 'Elimina cualquier roles del sistema',
        ]);

        //Roles
        DB::table('permissions')->insert([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista todos los roles del sistema',
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Ver pdf de roles',
            'slug'          => 'roles.show',
            'description'   => 'ver de todos los roles del sistema',
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Crear roles',
            'slug'          => 'roles.create',
            'description'   => 'Crea todos los roles del sistema',
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Editar roles',
            'slug'          => 'roles.edit',
            'description'   => 'Editar todos los roles del sistema',
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Elimina cualquier rol del sistema',
        ]);


        $this->call([
            Permission::class,
        ]);
    }
}
