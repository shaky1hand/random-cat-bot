<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CatApiService
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getRandomCatUrl(): ?string
    {
        try {
            $response = $this->httpClient->request('GET', 'https://cataas.com/cat?json=true');
            $content = $response->toArray();
            return $content['url'];
        } catch (\Exception $e) {
            return null;
        }
    }
}