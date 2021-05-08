<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            Role::firstOrCreate([
                'name' => 'super_admin'
            ]),
            Role::firstOrCreate([
                'name' => 'admin'
            ]),
            Role::firstOrCreate([
                'name' => 'moderator'
            ]),
            Role::firstOrCreate([
                'name' => 'user'
            ]),
        ];
    }
}
