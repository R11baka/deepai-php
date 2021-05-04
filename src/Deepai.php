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
     * @return DeepaiResponse
     * @throws Exception\HttpException
     * @throws \JsonException
     */
    public function colorize(string $fileContent): DeepaiResponse
    {
        $response = $this->httpClient->do('https://api.deepai.org/api/colorizer', 'POST', $fileContent, [
            'Api-Key' => $this->apiKey,
        ]);
        $output = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        return new DeepaiResponse($output['id'], $output['output_url']);
    }

    /**
     * @param string $filePath
     * @return DeepaiResponse
     * @throws BaseDeepaiException
     * @throws \JsonException
     */
    public function colorizeFromPath(string $filePath): DeepaiResponse
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
