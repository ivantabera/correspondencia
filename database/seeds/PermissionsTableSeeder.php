<?php

use Caffeinated\Shinobi\Contracts\Permission;
use Illuminate\Database\Seeder;

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
        Permission::create([
            'name'          => 'Navegar correspondencia',
            'slug'          => 'correspondencia.index',
            'description'   => 'Lista toda la correspondencia del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver pdf de correspondencia',
            'slug'          => 'correspondencia.pdf',
            'description'   => 'PDF de toda la correspondencia del sistema',
        ]);

        Permission::create([
            'name'          => 'Editar correspondencia',
            'slug'          => 'correspondencia.edit',
            'description'   => 'Editar toda la correspondencia del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'correspondencia.destroy',
            'description'   => 'Elimina cualquier roles del sistema',
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver pdf de roles',
            'slug'          => 'roles.show',
            'description'   => 'ver de todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Crear roles',
            'slug'          => 'roles.create',
            'description'   => 'Crea todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Editar roles',
            'slug'          => 'roles.edit',
            'description'   => 'Editar todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Elimina cualquier rol del sistema',
        ]);
    }
}
