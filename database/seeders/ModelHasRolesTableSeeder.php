<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $modelRoles = [
            ['role_id' => 1, 'model_type' => 'App\\Models\\User', 'model_id' => 1],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 5],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 6],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 7],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 8],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 9],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 10],
            ['role_id' => 2, 'model_type' => 'App\\Models\\User', 'model_id' => 12],
        ];

        DB::table('model_has_roles')->insert($modelRoles);
    }
}
