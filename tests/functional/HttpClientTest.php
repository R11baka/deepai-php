<?php


namespace R11baka\Deepai\Tests\functional;


use PHPUnit\Framework\TestCase;
use R11baka\Deepai\Exception\HttpException;
use R11baka\Deepai\HttpClient\CurlClient;

class HttpClientTest extends TestCase
{

    /**
     * @test
     * @throws \R11baka\Deepai\Exception\HttpException
     */
    public function httpGetClientRequest()
    {
        $client = new CurlClient([]);
        $url = 'https://httpbin.org/get';
        $resp = $client->do($url, 'GET', '', []);
        $this->assertTrue(200 === $resp->getStatusCode(), "StatusCode in not 200");
        $this->assertIsString($resp->getBody());
        $this->assertIsArray($resp->getHeaders());
    }

    /**
     * @test
     */
    public function httpPostClientRequest()
    {
        $client = new CurlClient([]);
        $url = 'https://httpbin.org/post';
        try {
            $resp = $client->do($url, 'POST', '', []);
            $this->assertTrue(200 === $resp->getStatusCode(), "StatusCode in not 200");
        } catch (HttpException $e) {
            $this->assertFalse(false, "Catch exception");
        }
    }
}
