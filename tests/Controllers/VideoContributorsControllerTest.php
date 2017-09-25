<?php


use App\Media\Video;
use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VideoContributorsControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_video_contributor_is_correctly_updated()
    {
        $video = factory(Video::class)->create();
        $profile = factory(Profile::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/media/videos/' . $video->id . '/contributors/' . $profile->id)
            ->assertResponseOk()
            ->seejson(['id' => $profile->id])
            ->seeInDatabase('videos', [
                'id' => $video->id,
                'profile_id' => $profile->id
            ]);
    }
}