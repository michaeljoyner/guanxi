<?php

use Illuminate\Database\Seeder;

class AffiliatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Affiliates\Affiliate::class, 9)->create(['published' => true]);
    }
}
