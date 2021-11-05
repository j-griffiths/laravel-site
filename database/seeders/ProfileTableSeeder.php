<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile;
        $profile->user_id = 1;
        $profile->forename = "John";
        $profile->surname = "Smith";
        $profile->profession = "Example Profession";
        $profile->website = "example.com";
        $profile->biography = "This is an example biography.";
        $profile->save();

        Profile::factory(10)->create();
    }
}
