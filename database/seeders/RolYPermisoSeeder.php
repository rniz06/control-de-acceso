<?php

namespace Database\Seeders;

use App\Models\Admin\Permiso;
use App\Models\Admin\Rol;
use App\Models\Admin\SysModulo;
use App\Models\Admin\SysSubModulo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolYPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SysModulo::create([
            'modulo' => 'ADMIN'
        ]);

        SysModulo::create([
            'modulo' => 'CONTROL DE ACCESO'
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'USUARIOS',
            'modulo_id' => 1
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'ROLES',
            'modulo_id' => 1
        ]);

        SysSubModulo::create([
            'sub_modulo' => 'PANEL CENTRAL',
            'modulo_id' => 2
        ]);


        $permisos = [
            // RUTAS DEL MODULO USUARIOS
            ['permiso' => 'SuperAdmin',              'modulo_id' => 1, 'sub_modulo_id' => 1],

            // RUTAS DEL MODULO USUARIOS
            ['permiso' => 'Usuarios Listar',              'modulo_id' => 1, 'sub_modulo_id' => 1],
            ['permiso' => 'Usuarios Crear',               'modulo_id' => 1, 'sub_modulo_id' => 1],
            ['permiso' => 'Usuarios Ver',                 'modulo_id' => 1, 'sub_modulo_id' => 1],
            ['permiso' => 'Usuarios Editar',              'modulo_id' => 1, 'sub_modulo_id' => 1],
            ['permiso' => 'Usuarios Activar/Inactivar',           'modulo_id' => 1, 'sub_modulo_id' => 1],
            ['permiso' => 'Usuarios Resetear Contrasena', 'modulo_id' => 1, 'sub_modulo_id' => 1],
            ['permiso' => 'Usuarios Asignar Rol',         'modulo_id' => 1, 'sub_modulo_id' => 1],
            //['permiso' => 'Usuarios Exportar Excel',      'modulo_id' => 1, 'sub_modulo_id' => 1],
            //['permiso' => 'Usuarios Exportar Pdf',        'modulo_id' => 1, 'sub_modulo_id' => 1],

            // RUTAS DEL MODULO ROLES
            ['permiso' => 'Roles Listar',            'modulo_id' => 1, 'sub_modulo_id' => 2],
            ['permiso' => 'Roles Crear',             'modulo_id' => 1, 'sub_modulo_id' => 2],
            ['permiso' => 'Roles Editar',            'modulo_id' => 1, 'sub_modulo_id' => 2],
            //['permiso' => 'Roles Exportar Excel',  'modulo_id' => 1, 'sub_modulo_id' => 2],
            //['permiso' => 'Roles Exportar Pdf',    'modulo_id' => 1, 'sub_modulo_id' => 2],
        ];

        foreach ($permisos as $permiso) {
            Permiso::create([
                'name'          => $permiso['permiso'],
                'modulo_id'     => $permiso['modulo_id'],
                'sub_modulo_id' => $permiso['sub_modulo_id'],
            ]);
        }

        // CREAR USUARIO ADMINISTRADOR
        $user = User::create([
            'name' => 'Administrador',
            'usuario' => 'Administrador',
            'email' => 'ronaldalexisniznunez@gmail.com',
            'nro_cedula' => null,
            'nro_celular' => null,
            'observacion' => 'USUARIO ADMINISTRADOR DEL SISTEMA',
            'password' => Hash::make('Rann2006'),
            'activo'  => true,
            'ultimo_acceso'  => null,
        ]);

        // CREAR ROL "ADMIN"
        $role = Rol::create(['name' => 'SuperAdmin']);

        // ASIGNAR TODOS LOS PERMISOS CREADOS AL ROL "SuperAdmin"
        $permissions = Permiso::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
