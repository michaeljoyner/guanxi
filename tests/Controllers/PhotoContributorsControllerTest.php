<?php


use App\Media\Photo;
use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhotoContributorsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_photos_contributor_is_correctly_updated()
    {
        $photo = factory(Photo::class)->create();
        $profile = factory(Profile::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/media/photos/' . $photo->id . '/contributors/' . $profile->id)
            ->assertResponseOk()
            ->seejson(['id' => $profile->id])
            ->seeInDatabase('photos', [
                'id' => $photo->id,
                'profile_id' => $profile->id
            ]);
    }
}