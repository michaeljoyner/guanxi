<?php


use App\FormattedUrl;

class FormattedUrlTest extends BrowserKitTestCase
{
    /**
     *@test
     */
    public function it_returns_a_correctly_formatted_url_unchanged()
    {
        $url = 'https://example.com';

        $this->assertEquals('https://example.com', FormattedUrl::from($url));
    }

    /**
     *@test
     */
    public function it_adds_a_missing_http_by_default()
    {
        $url = 'example.com';

        $this->assertEquals('http://example.com', FormattedUrl::from($url));
    }

    /**
     *@test
     */
    public function it_adds_a_missing_https_if_secure_flag_is_true()
    {
        $url = 'example.com';

        $this->assertEquals('https://example.com', FormattedUrl::from($url, true));
    }
}