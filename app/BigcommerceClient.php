<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BigcommerceClient
{
    protected $client;
    protected $response;

    public function __construct($version = 'v2')
    {
        $this->client = new Client([
            'base_uri' => sprintf('%s/api/%s/', env('BIGCOMMERCE_STORE'), $version),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'verify' => false,
            'auth' => [
                env('BIGCOMMERCE_USERNAME'),
                env('BIGCOMMERCE_API_KEY')
            ]
        ]);
    }

    public function call($method, $uri, $options = [])
    {
        try {
            $this->response = $this->client->request($method, $uri, $options);
        } catch (GuzzleException $e) {
            abort(404);
        }

        return $this;
    }

    public function decode()
    {
        return json_decode($this->response->getBody()->getContents());
    }
}