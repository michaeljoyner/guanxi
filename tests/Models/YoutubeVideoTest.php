<?php


use App\Media\EmbeddedVideo\YoutubeVideo;
use App\Services\JsonPayload;

class YoutubeVideoTest extends TestCase
{
    /**
     *@test
     */
    public function it_can_generate_the_correct_endpoint_from_a_video_url()
    {
        $youtubeLinks = [
            'http://youtu.be/NLqAFTWOVbY',
            'http://www.youtube.com/embed/NLqAFTWOVbY',
            'https://www.youtube.com/embed/NLqAFTWOVbY',
            'http://www.youtube.com/v/NLqAFTWOVbY?fs=1&hl=en_US',
            'http://www.youtube.com/watch?v=NLqAFTWOVbY',
            'http://www.youtube.com/user/Scobleizer#p/u/1/NLqAFTWOVbY',
            'http://www.youtube.com/ytscreeningroom?v=NLqAFTWOVbY',
            'http://www.youtube.com/user/Scobleizer#p/u/1/NLqAFTWOVbY',
            'http://www.youtube.com/watch?v=NLqAFTWOVbY&feature=featured'
        ];
        $expectedEndpoint = 'https://www.googleapis.com/youtube/v3/videos?part=id%2Csnippet&id=NLqAFTWOVbY&key=' . env('YOUTUBE_API_KEY');

        collect($youtubeLinks)->each(function($link) use ($expectedEndpoint) {
           $video = new YoutubeVideo($link, new \App\Services\JsonPayload());
            $this->assertEquals($expectedEndpoint, $video->endpoint);
        });
    }

    /**
     *@test
     */
    public function it_presents_the_correct_attributes_to_create_translated_video_model()
    {
        $json = $this->createMock(JsonPayload::class);
        $json->method('fetch')->willReturn(json_decode(file_get_contents('tests/resources/youtube.json')));

        $video = new YoutubeVideo('http://www.youtube.com/watch?v=NLqAFTWOVbY', $json);

        $expectedData = [
            'title' => 'Top 10 Best Playstation 4 Games',
            'zh_title' => '',
            'description' => 'This is the modified description to make testing a better nightmare',
            'zh_description' => '',
            'video_url' => 'http://www.youtube.com/watch?v=NLqAFTWOVbY',
            'embed_url' => 'https://youtube.com/embed/NLqAFTWOVbY'
        ];

        $this->assertEquals($expectedData, $video->attributes());
    }
}