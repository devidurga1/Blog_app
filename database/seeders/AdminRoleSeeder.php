<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role; 

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the admin role already exists
        $existingAdminRole = Role::where('name', 'admin')->first();

        if (!$existingAdminRole) {
            // Create the admin role
            Role::create([
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'web',
                
            ]);
        }
    }
}
