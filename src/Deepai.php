<?php
declare(strict_types=1);

namespace R11baka\Deepai;

use InvalidArgumentException;
use R11baka\Deepai\Exception\BaseDeepaiException;
use R11baka\Deepai\HttpClient\CurlClient;
use R11baka\Deepai\HttpClient\HttpClient;
use R11baka\Deepai\HttpClient\Response;

/**
 * main class for interaction with deepai.org colorizer
 * Class Deepai
 * @package R11baka\Deepai
 */
class Deepai
{
    private HttpClient $httpClient;
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        if (empty($apiKey) || is_string($apiKey) === false) {
            throw new InvalidArgumentException("Incorrect apiKey:$apiKey");
        }
        $this->httpClient = new CurlClient(['headers' => ['Api-Key' => $apiKey]]);
        $this->apiKey = $apiKey;
    }

    /**
     * @param HttpClient $client
     * @return Deepai
     */
    public function withHttpClient(HttpClient $client): self
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * @param string $fileContent
     * @return Response
     * @throws Exception\HttpException
     */
    public function colorize(string $fileContent): Response
    {
        $resp = $this->httpClient->do('https://api.deepai.org/api/colorizer', 'POST', $fileContent, [
            'Api-Key' => $this->apiKey,
        ]);

        return $resp;
    }

    /**
     * @param string $filePath
     * @return Response
     * @throws BaseDeepaiException
     */
    public function colorizeFromPath(string $filePath): Response
    {
        if (file_exists($filePath) === false) {
            throw new BaseDeepaiException("File $filePath not found");
        }
        $fileContent = file_get_contents($filePath);
        if (empty($fileContent)) {
            throw new BaseDeepaiException("File content empty! " . $filePath);
        }
        return $this->colorize($fileContent);
    }

}
