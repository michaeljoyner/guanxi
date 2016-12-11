<?php


use App\Media\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VideosControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_videos_title_and_description_may_be_updated()
    {
        $this->asLoggedInUser();
        $video = factory(Video::class)->create();

        $this->post('/admin/media/videos/' . $video->id, [
            'title' => 'New updated title',
            'zh_title' => 'Xinde mingze',
            'description' => 'An acme video that has een updated',
            'zh_description' => 'A chinese description'
        ])->assertResponseStatus(302)
            ->seeInDatabase('videos', [
                'id' => $video->id,
                'title' => json_encode(['en' => 'New updated title', 'zh' => 'Xinde mingze']),
                'description' => json_encode(['en' => 'An acme video that has een updated', 'zh' => 'A chinese description']),
                'video_url' => $video->video_url,
                'embed_url' => $video->embed_url
            ]);
    }

    /**
     *@test
     */
    public function a_video_may_be_deleted()
    {
        $this->asLoggedInUser();
        $video = factory(Video::class)->create();

        $this->delete('/admin/media/videos/' . $video->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('videos', ['id' => $video->id]);
    }
}