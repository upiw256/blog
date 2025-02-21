<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the 'web' role and get its ID
        $roleId = DB::table('roles')->insertGetId([
            'name' => 'web',
            'guard_name' => 'web',
        ]);

        // Check if the role already exists before assigning
        if (!DB::table('model_has_roles')->where('role_id', $roleId)->where('model_id', 1)->exists()) {


            // Assign the role to the user
            DB::table('model_has_roles')->insert([
                'role_id' => $roleId,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1, // Assuming the user ID is 1
            ]);
        }

    }
}
