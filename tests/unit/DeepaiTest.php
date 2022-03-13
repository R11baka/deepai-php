<?php

namespace R11baka\Deepai\Tests\unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use R11baka\Deepai\Deepai;
use R11baka\Deepai\Exception\BaseDeepaiException;
use R11baka\Deepai\HttpClient\CurlClient;
use R11baka\Deepai\HttpClient\Response;

class DeepaiTest extends TestCase
{

    /**
     * @test
     * @throws BaseDeepaiException
     * @throws \JsonException
     */
    public function itThrowsExceptionFileNotExists()
    {
        $this->expectException(BaseDeepaiException::class);
        $colorizer = new Deepai('111');
        $colorizer->colorizeFromPath("NotExistsPath");
    }

    /**
     * @test
     */
    public function itThrowsExceptionEmptyApiKey()
    {
        $this->expectException(InvalidArgumentException::class);
        new Deepai('');
    }

    /**
     * @test
     */
    public function colorizeFile()
    {
        $dp = new Deepai('API_KEY');
        $dp->withHttpClient(
            new  class () extends CurlClient {
                public function do(string $url, string $method, string $body, array $headers): Response
                {
                    return new Response(200, [], json_encode(['id' => '111', 'output_url' => 'url']));
                }
            }
        );
        $resp = $dp->colorize("123313123");
        $this->assertEquals($resp->getId(), '111');
        $this->assertEquals($resp->getUrl(), 'url');
    }
}
