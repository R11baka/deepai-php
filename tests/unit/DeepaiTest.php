<?php

namespace R11baka\Deepai\Tests\unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use R11baka\Deepai\Deepai;
use R11baka\Deepai\Exception\BaseDeepaiException;

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
}
