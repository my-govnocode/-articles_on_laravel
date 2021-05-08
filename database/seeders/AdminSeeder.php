<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            User::firstOrCreate([
                'name' => 'admin',
                'email' => env('MAIL_ADMIN'),
                'role' => 2,
                'password' => password_hash(12345678 , PASSWORD_BCRYPT),
            ]),
        ];
    }
}
