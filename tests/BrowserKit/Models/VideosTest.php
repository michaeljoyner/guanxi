<?php


use App\Media\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VideosTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function videos_can_be_created_and_persisted()
    {
        $video = factory(Video::class)->create();

        $this->assertInstanceOf(Video::class, $video);
    }

    /**
     * @test
     */
    public function a_video_is_unpublished_by_default()
    {
        $video = factory(Video::class)->create();

        $this->assertFalse($video->published);
    }

    /**
     * @test
     */
    public function an_unpublished_video_may_be_published()
    {
        $video = factory(Video::class)->create();
        $video->publish();
        $video = $video->fresh();

        $this->assertTrue($video->published);
    }

    /**
     * @test
     */
    public function a_published_video_may_be_retracted()
    {
        $video = factory(Video::class)->create(['published' => true]);
        $this->assertTrue($video->published);

        $video->retract();
        $video = $video->fresh();

        $this->assertFalse($video->published);
    }

    /**
     *@test
     */
    public function a_video_can_be_created_with_translations()
    {
        $data = [
            'title' => 'Life is Beautiful',
            'zh_title' => 'Life is Pioa Liang',
            'description' => 'A real tear jerker',
            'zh_description' => 'Makes me sad',
            'video_url' => 'https://youtube.com/123456',
            'embed_url' => 'https://youtube.com/embed/123456'
        ];

        $video = Video::createWithTranslations($data);

        $this->assertEquals('Life is Beautiful', $video->getTranslation('title', 'en'));
        $this->assertEquals('Life is Pioa Liang', $video->getTranslation('title', 'zh'));
        $this->assertEquals('A real tear jerker', $video->getTranslation('description', 'en'));
        $this->assertEquals('Makes me sad', $video->getTranslation('description', 'zh'));
        $this->assertEquals('https://youtube.com/123456', $video->video_url);
        $this->assertEquals('https://youtube.com/embed/123456', $video->embed_url);
    }

    /**
     *@test
     */
    public function a_video_can_be_updated_with_translations()
    {
        $video = factory(Video::class)->create();
        $original_title = $video->getTranslation('title', 'en');
        $original_description = $video->getTranslation('description', 'en');
        $original_url = $video->video_url;
        $data = [
            'zh_title' => 'Life is Pioa Liang',
            'zh_description' => 'Makes me sad',
        ];

        $video->updateWithTranslations($data);

        $this->assertEquals($original_title, $video->getTranslation('title', 'en'));
        $this->assertEquals('Life is Pioa Liang', $video->getTranslation('title', 'zh'));
        $this->assertEquals($original_description, $video->getTranslation('description', 'en'));
        $this->assertEquals('Makes me sad', $video->getTranslation('description', 'zh'));
        $this->assertEquals($original_url, $video->video_url);
    }

    /**
     *@test
     */
    public function a_video_can_supply_its_own_embed_html()
    {
        $video = factory(Video::class)->create(['embed_url' => 'https://player.vimeo.com/video/12345']);
        $expected = '<iframe src="https://player.vimeo.com/video/12345" width="800" height="450" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

        $this->assertEquals($expected, $video->embedHtml());

    }
}