<?php


use App\Media\EmbeddedVideo\VimeoVideo;
use App\Media\EmbeddedVideo\YoutubeVideo;
use App\Media\UnknownPlatformException;
use App\Media\VideoFactory;

class VideoFactoryTest extends BrowserKitTestCase
{
    /**
     * @test
     */
    public function it_generates_a_youtube_video_for_a_youtube_link()
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

        collect($youtubeLinks)->each(function ($link) {
            $video = VideoFactory::createEmbeddedVideo($link);
            $this->assertInstanceOf(YoutubeVideo::class, $video);
        });
    }

    /**
     *@test
     */
    public function it_creates_a_vimeo_video_for_a_vimeo_link()
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
            $video = VideoFactory::createEmbeddedVideo($url);
            $this->assertInstanceOf(VimeoVideo::class, $video);
        });
    }

    /**
     *@test
     */
    public function an_exception_is_thrown_if_the_link_is_not_from_a_valid_platform()
    {
        $this->expectException(UnknownPlatformException::class);

        $video = VideoFactory::createEmbeddedVideo('http://dymanticdesign.com');
    }
}