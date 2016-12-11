<?php


use App\Media\EmbeddedVideo\VimeoVideo;
use App\Services\JsonPayload;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VimeoVideosTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function it_generates_the_correct_vimeo_endpoint_for_a_link()
    {
        $vimeoUrls = [
            'http://vimeo.com/6701902',
            'http://vimeo.com/670190233',
            'http://player.vimeo.com/video/67019023',
            'http://player.vimeo.com/video/6701902',
            'http://player.vimeo.com/video/67019022?title=0&byline=0&portrait=0',
            'http://player.vimeo.com/video/6719022?title=0&byline=0&portrait=0',
            'http://vimeo.com/channels/vimeogirls/6701902',
            'http://vimeo.com/channels/vimeogirls/67019023',
            'http://vimeo.com/channels/staffpicks/67019026',
            'http://vimeo.com/15414122',
            'http://vimeo.com/channels/vimeogirls/66882931'
        ];


        collect($vimeoUrls)->each(function($url) {
            $expectedEndpoint = 'https://vimeo.com/api/oembed.json?' . http_build_query(['url' => $url]);
            $video = new VimeoVideo($url, new \App\Services\JsonPayload());
            $this->assertEquals($expectedEndpoint, $video->endpoint);
        });
    }

    /**
     *@test
     */
    public function it_presents_the_correct_attributes_to_create_a_translated_video_model()
    {
        $json = $this->createMock(JsonPayload::class);
        $json->method('fetch')->willReturn(json_decode(file_get_contents('tests/resources/vimeo.json')));

        $video = new VimeoVideo('http://vimeo.com/670190233', $json);

        $expectedData = [
            'title' => 'This is a test video title',
            'zh_title' => '',
            'description' => 'What a wonderful description of this fake video data',
            'zh_description' => '',
            'video_url' => 'http://vimeo.com/670190233',
            'embed_url' => 'https://player.vimeo.com/video/670190233'
        ];

        $this->assertEquals($expectedData, $video->attributes());
    }
}