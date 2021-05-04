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
     */
    public function it_throws_exception_file_not_exists()
    {
        $this->expectException(BaseDeepaiException::class);
        $colorizer = new Deepai('111');
        $colorizer->colorizeFromPath("NotExistsPath");
    }

    /**
     * @test
     */
    public function it_throws_exception_empty_api_key()
    {
        $this->expectException(InvalidArgumentException::class);
        $colorizer = new Deepai('');
    }

}
