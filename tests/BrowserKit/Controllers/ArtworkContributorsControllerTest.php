<?php


use App\Media\Artwork;
use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtworkContributorsControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_artworks_contributor_is_successfully_updated()
    {
        $artwork = factory(Artwork::class)->create();
        $profile = factory(Profile::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/media/artworks/' . $artwork->id . '/contributors/' . $profile->id)
            ->assertResponseOk()
            ->seejson(['id' => $profile->id])
            ->seeInDatabase('artworks', [
                'id' => $artwork->id,
                'profile_id' => $profile->id
            ]);
    }
}