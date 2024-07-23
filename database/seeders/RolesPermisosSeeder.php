<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Misc
        $permisoGeneral = Permission::create(['name' => 'N/A']);

        // USER MODEL
        $permisoUsuario1 = Permission::create(['name' => 'create: user']);
        $permisoUsuario2 = Permission::create(['name' => 'read: user']);
        $permisoUsuario3 = Permission::create(['name' => 'update: user']);
        $permisoUsuario4 = Permission::create(['name' => 'delete: user']);

        // ROLE MODEL
        $permisoRol1 = Permission::create(['name' => 'create: role']);
        $permisoRol2 = Permission::create(['name' => 'read: role']);
        $permisoRol3 = Permission::create(['name' => 'update: role']);
        $permisoRol4 = Permission::create(['name' => 'delete: role']);

        // PERMISSION MODEL
        $permiso1 = Permission::create(['name' => 'create: permission']);
        $permiso2 = Permission::create(['name' => 'read: permission']);
        $permiso3 = Permission::create(['name' => 'update: permission']);
        $permiso4 = Permission::create(['name' => 'delete: permission']);

        // ADMINS
        $permisoAdmin1 = Permission::create(['name' => 'read: admin']);
        $permisoAdmin2 = Permission::create(['name' => 'update: admin']);

        // CREATE ROLES
        $usuarioRol = Role::create(['name' => 'user'])->syncPermissions([
            $permisoGeneral,
        ]);

        $superAdminRole = Role::create(['name' => 'Administrador'])->syncPermissions([
            $permisoUsuario1,
            $permisoUsuario2,
            $permisoUsuario3,
            $permisoUsuario4,
            $permisoRol1,
            $permisoRol2,
            $permisoRol3,
            $permisoRol4,
            $permiso1,
            $permiso2,
            $permiso3,
            $permiso4,
            $permisoAdmin1,
            $permisoAdmin2,
            $permisoUsuario1,
        ]);
        $adminRole = Role::create(['name' => 'Gerente'])->syncPermissions([
            $permisoUsuario1,
            $permisoUsuario2,
            $permisoUsuario3,
            $permisoUsuario4,
            $permisoRol1,
            $permisoRol2,
            $permisoRol3,
            $permisoRol4,
            $permiso1,
            $permiso2,
            $permiso3,
            $permiso4,
            $permisoAdmin1,
            $permisoAdmin2,
            $permisoUsuario1,
        ]);
        $moderatorRole = Role::create(['name' => 'vendedor'])->syncPermissions([
            $permisoUsuario2,
            $permisoRol2,
            $permiso2,
            $permisoAdmin1,
        ]);

        // CREATE ADMINS & USERS
        User::create([
            'name' => 'super admin',
            'is_admin' => 1,
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@ae.com',
            'is_admin' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
        ])->assignRole($superAdminRole);;

        User::create([
            'name' => 'David',
            'email' => 'triminio@ae.com',
            'is_admin' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);;

        User::create([
            'name' => 'Luis Angel',
            'email' => 'l_ortez@ae.com',
            'email_verified_at' => now(),
            'is_admin' => 1,
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);;

        User::create([
            'name' => 'Claudia',
            'email' => 'claudia@ae.com',
            'email_verified_at' => now(),
            'is_admin' => 1,
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);;

        User::create([
            'name' => 'Selvin',
            'is_admin' => 1,
            'email_verified_at' => now(),
            'email' => 's_plata@ae.com',
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);;

        User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($adminRole);

        User::create([
            'name' => 'moderator',
            'is_admin' => 1,
            'email' => 'moderator@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($moderatorRole);

        User::create([
            'name' => 'test',
            'email' => '12345@ae.com',
            'is_admin' => 0,
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);;


        User::factory(10)->create();
    }
}
