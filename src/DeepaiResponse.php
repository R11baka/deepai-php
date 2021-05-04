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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @var string
     */
    private string $filePath;

    /**
     * DeepaiResponse constructor.
     * @param string $id
     * @param string $filePath
     */
    public function __construct(string $id, string $filePath)
    {
        $this->id = $id;
        $this->filePath = $filePath;
    }


}
