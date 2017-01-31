<?php

use Illuminate\Database\Seeder;

class BiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\People\Profile::class, 6)->create(['published' => true]);
    }
}
