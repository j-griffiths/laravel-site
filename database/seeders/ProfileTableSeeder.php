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
        $profile->id = 1;
        $profile->user_id = 1;
        $profile->display_name = "John Smith";
        $profile->profession = "Example Profession";
        $profile->website = "example.com";
        $profile->biography = "This is an example biography.";
        $profile->save();

        $profile = new Profile;
        $profile->id = 2;
        $profile->user_id = 2;
        $profile->display_name = "Keanu Reeves";
        $profile->profession = "Matrix Man";
        $profile->website = "keanu.com";
        $profile->biography = "Keanu Reeves fan account.";
        $profile->save();

        Profile::factory(20)->create();
    }
}
