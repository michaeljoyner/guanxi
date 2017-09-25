<?php


use App\Media\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VideoPublishingControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_video_gets_published_correctly()
    {
        $this->asLoggedInUser();
        $video = factory(Video::class)->create(['published' => false]);

        $this->post('/admin/media/videos/' . $video->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('videos', [
                'id' => $video->id,
                'published' => 1
            ]);
    }

    /**
     *@test
     */
    public function a_video_is_correctly_retracted()
    {
        $this->asLoggedInUser();
        $video = factory(Video::class)->create(['published' => true]);

        $this->post('/admin/media/videos/' . $video->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('videos', [
                'id' => $video->id,
                'published' => 0
            ]);
    }
}