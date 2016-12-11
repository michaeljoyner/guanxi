<?php


namespace App\Media\EmbeddedVideo;


class YoutubeVideo implements EmbeddedVideo
{
    private $link;
    private $json;
    public $endpoint = null;

    /**
     * YoutubeVideo constructor.
     * @param $link
     * @param $json
     */
    public function __construct($link, $json)
    {
        $this->link = $link;
        $this->json = $json;
        $this->endpoint = $this->generateEndpoint();
    }

    public function attributes()
    {
        $data = $this->json->fetch($this->endpoint);

        return [
            'title'          => $data->items[0]->snippet->title,
            'zh_title'       => '',
            'description'    => $data->items[0]->snippet->description,
            'zh_description' => '',
            'video_url'      => $this->link,
            'embed_url' => 'https://youtube.com/embed/' . $data->items[0]->id
        ];
    }

    protected function generateEndpoint()
    {
        $params = [
            'part' => 'id,snippet',
            'id'   => $this->extractVideoId(),
            'key'  => env('YOUTUBE_API_KEY')
        ];

        return 'https://www.googleapis.com/youtube/v3/videos?' . http_build_query($params);
    }

    private function extractVideoId()
    {
        $matches = [];
        $containsId = $this->trimToVAttributeValue($this->getFinalUrlPart());
        preg_match('/^([a-zA-Z\-\_0-9]+)/', $containsId, $matches);

        return $matches[1];
    }

    private function getFinalUrlPart()
    {
        $parts = explode('/', $this->link);

        return array_pop($parts);
    }

    private function trimToVAttributeValue($urlPart)
    {
        if (str_contains($urlPart, 'v=')) {
            return substr($urlPart, strpos($urlPart, 'v=') + 2);
        }

        return $urlPart;
    }
}