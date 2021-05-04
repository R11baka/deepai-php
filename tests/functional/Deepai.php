<?php


namespace R11baka\Deepai\Tests\functional;


use PHPUnit\Framework\TestCase;

class Deepai extends TestCase
{
    private string $apiKey;

    public function setUp(): void
    {
        parent::setUp();
        $this->apiKey = getenv('DEEPAI_API_KEY');
    }

    /**
     * @test
     */
    public function colorize()
    {
        $dp = new \R11baka\Deepai\Deepai($this->apiKey);
        $resp = $dp->colorizeFromPath('./lena.jpg');
        $this->assertIsObject($resp);
        $this->assertIsString($resp->getUrl());
        $this->assertIsString($resp->getId());

    }

}
