<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use App\Models\Role;
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
                    'role' => Role::where('name','admin')->value('id'),
                    'password' => Hash::make(12345678),         
                ],
        );
    }
}
