<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new \App\City();
        $city->name = 'ha noi';
        $city ->save();

        $city = new \App\City();
        $city->name = 'Hà Nam';
        $city ->save();

        $city = new \App\City();
        $city->name = 'Hà Tĩnh';
        $city ->save();

        $city = new \App\City();
        $city->name = 'Hà Giang';
        $city ->save();

    }
}
