<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class JsonPayload
{

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetch($endpoint)
    {
        try {
            $response = $this->client->get($endpoint);
        } catch( ClientException $e) {
            throw new JsonIrretrievableException('Failed to retrieve json');
        } catch( ServerException $severException) {
            throw new ServiceFailedException($severException->getMessage());
        }

        $body = json_decode($response->getBody()->getContents());

        if(json_last_error() === JSON_ERROR_NONE) {
            return $body;
        }

        throw new JsonInvalidException('Response was not valid json');
    }
}