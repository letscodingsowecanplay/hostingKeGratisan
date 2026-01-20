<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['id' => 1, 'name' => 'user_access', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'user_create', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'user_edit', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'user_delete', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'role_access', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'role_create', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'role_edit', 'guard_name' => 'web'],
            ['id' => 8, 'name' => 'role_delete', 'guard_name' => 'web'],
            ['id' => 9, 'name' => 'permission_access', 'guard_name' => 'web'],
            ['id' => 10, 'name' => 'permission_create', 'guard_name' => 'web'],
            ['id' => 11, 'name' => 'permission_edit', 'guard_name' => 'web'],
            ['id' => 12, 'name' => 'permission_delete', 'guard_name' => 'web'],
            ['id' => 13, 'name' => 'materi_access', 'guard_name' => 'web'],
            ['id' => 14, 'name' => 'evaluasi_access', 'guard_name' => 'web'],
            ['id' => 15, 'name' => 'datasiswa_access', 'guard_name' => 'web'],
            ['id' => 16, 'name' => 'datalatihansiswa_access', 'guard_name' => 'web'],
            ['id' => 17, 'name' => 'datahasilbelajarsiswa_access', 'guard_name' => 'web'],
            ['id' => 18, 'name' => 'editkkm_access', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
