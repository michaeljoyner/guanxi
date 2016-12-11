<?php


namespace App\Media\EmbeddedVideo;


class VimeoVideo implements EmbeddedVideo
{

    const ENPOINT_BASE = 'https://vimeo.com/api/oembed.json?';
    public $endpoint = null;
    private $link;
    private $json;

    public function __construct($link, $json)
    {
        $this->link = $link;
        $this->json = $json;
        $this->endpoint = $this->generateEndpoint();
    }

    private function generateEndpoint()
    {
        return static::ENPOINT_BASE . http_build_query(['url' => $this->link]);
    }

    public function attributes()
    {
        $data = $this->json->fetch($this->endpoint);

        return [
            'title' => $data->title ?? 'Title not provided',
            'zh_title' => '',
            'description' => $data->description ?? 'Description not provided',
            'zh_description' => '',
            'video_url' => $this->link,
            'embed_url' => 'https://player.vimeo.com/video/' . $data->video_id
        ];
    }
}