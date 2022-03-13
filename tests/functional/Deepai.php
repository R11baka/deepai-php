<?php

namespace R11baka\Deepai\Tests\functional;

use PHPUnit\Framework\TestCase;
use R11baka\Deepai\Exception\IncorrectApiKey;

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

    /**
     * @test
     */
    public function colorizeWithIncorrectKey()
    {
        $dp = new \R11baka\Deepai\Deepai('1111');
        $this->expectException(IncorrectApiKey::class);
        $dp->colorizeFromPath('./lena.jpg');
    }
}
