<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = User::create([
            'name' => 'adminsuper',
            'email' => 'admin@hot.com',
            'password' => bcrypt('admin123'),
        ]);
        
        $rol = Role::create(['name' => 'Administrador']);
        $permisos = Permission::pluck('id')->all();
        $rol->syncPermissions($permisos);
        $usuario->assignRole([$rol->id]);
        
    }
}
