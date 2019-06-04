<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use \Uiza\ApiRequestor;
use \Uiza\ApiResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class TestBase extends TestCase
{
    protected function setUp()
    {
        \Uiza\Base::setApiKey('api key test');
        \Uiza\Base::setAppId('your-app-id');

        // Save original values so that we can restore them after running tests
        $this->apiBase = \Uiza\Base::$apiBase;

        $this->apiKey = \Uiza\Base::$apiKey;

        $this->apiVersion = \Uiza\Base::$apiVersion;
    }

    protected function mockData($data)
    {
        // Create a mock subscriber and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], json_encode($data)),         // Use response object
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        ApiRequestor::setHttpClient($client);
    }

    protected function mockDataError($statusCode)
    {
        $mockError = new MockHandler([
            new Response($statusCode, []),         // Use response object
        ]);

        $handlerStack = HandlerStack::create($mockError);
        $client = new Client(['handler' => $handlerStack]);

        ApiRequestor::setHttpClient($client);
    }

    protected function statusCode()
    {
        $statusCode4xx = rand(400,499);
        $statusCode5xx = rand(500,599);

        return [
            400 => 'The request was unacceptable, often due to missing a required parameter',
            401 => 'No valid API key provided.',
            404 => 'The requested resource doesn\'t exist.',
            422 => 'The syntax of the request is correct (often cause of wrong parameter)',
            500 => 'We had a problem with our server. Try again later.',
            503 => 'The server is overloaded or down for maintenance.',
            $statusCode4xx => 'The error seems to have been caused by the client.',
            $statusCode5xx => 'The server is aware that it has encountered an error.'
        ];
    }
}
