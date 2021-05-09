<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsersOnRoleAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create(
                [
                    'name' => 'admin',
                    'email' => env('MAIL_ADMIN'),
                    'role' => 1,
                    'password' => Hash::make(12345678),               
                ],
        );
    }
}
