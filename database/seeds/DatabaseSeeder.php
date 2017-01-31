<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BiosTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(AffiliatesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(ArtworksTableSeeder::class);
    }
}
