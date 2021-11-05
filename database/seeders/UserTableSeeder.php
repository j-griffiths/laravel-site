<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Example";
        $user->email = "example@test.com";
        $user->email_verified_at = now();
        $user->password = "password";
        $user->remember_token = "rememberme";
        $user->save();

        User::factory(10)->create();
    }
}
