<?php

use Illuminate\Database\Seeder;

class ArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = \App\People\Profile::find(4);
        $profile2 = \App\People\Profile::find(5);
        $profile3 = \App\People\Profile::find(6);
        $profile4 = \App\People\Profile::find(7);

        factory(\App\Media\Artwork::class, 3)->create(['published' => true, 'profile_id' => $profile->id]);
        factory(\App\Media\Artwork::class, 3)->create(['published' => true, 'profile_id' => $profile2->id]);
        factory(\App\Media\Artwork::class, 3)->create(['published' => true, 'profile_id' => $profile3->id]);
        factory(\App\Media\Artwork::class, 3)->create(['published' => true, 'profile_id' => $profile4->id]);
    }
}
