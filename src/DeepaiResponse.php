<?php

declare(strict_types=1);

namespace R11baka\Deepai;

/**
 * Class DeepaiResponse
 * @package R11baka\Deepai\HttpClient
 */
class DeepaiResponse
{
    /**
     * @var string contains id from response
     */
    private string $id;
    /**
     * @var string
     */
    private string $url;

    /**
     * DeepaiResponse constructor.
     * @param string $id
     * @param string $filePath
     */
    public function __construct(string $id, string $filePath)
    {
        $this->id = $id;
        $this->url = $filePath;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
