<?php


namespace R11baka\Deepai\Tests\unit;


use PHPUnit\Framework\TestCase;
use R11baka\Deepai\Deepai;
use R11baka\Deepai\Exception\BaseDeepaiException;
use R11baka\Deepai\HttpClient\CurlClient;

class DeepaiTest extends TestCase
{

    /**
     * @test
     * @throws BaseDeepaiException
     */
    public function colorizeFromPathException()
    {
        $this->expectException(BaseDeepaiException::class);
        $colorizer = new Deepai('111');
        $colorizer->colorizeFromPath("NotExistsUrl");
    }

}
