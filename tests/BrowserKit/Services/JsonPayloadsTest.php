<?php


use App\Services\JsonInvalidException;
use App\Services\JsonIrretrievableException;
use App\Services\JsonPayload;

class JsonPayloadsTest extends BrowserKitTestCase
{
    /**
     *@test
     */
    public function given_a_valid_endpoint_url_it_can_fetch_and_return_a_json_payload()
    {
        $url = 'https://jsonplaceholder.typicode.com/posts/1';

        $payload = (new JsonPayload())->fetch($url);

        $this->assertObjectHasAttribute('id', $payload);
        $this->assertObjectHasAttribute('title', $payload);
    }

    /**
     *@test
     */
    public function an_endpoint_response_that_is_400_throws_an_irretrievable_exception()
    {
        $url = 'https://dymanticdesign.com/not-a-real-endpoint'; //does not exist

        $this->expectException(JsonIrretrievableException::class);
        $payload = (new JsonPayload())->fetch($url);
    }

    /**
     *@test
     */
    public function a_successful_response_with_invalid_json_throws_a_jsoninvalidexception()
    {
        $url = 'https://dymanticdesign.com'; //does exist

        $this->expectException(JsonInvalidException::class);
        $payload = (new JsonPayload())->fetch($url);
    }
}