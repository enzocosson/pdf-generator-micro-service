<?php

use Symfony\Contracts\HttpClient\HttpClientInterface;

class MyHttpClient
{
    private string $accessToken;

    public function __construct(private HttpClientInterface $client, string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function fetchDataFromApi(): array
    {
        // Définir les en-têtes de la requête avec le jeton d'authentification Bearer
        $headers = [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
        ];

        $response = $this->client->request(
            'GET',
            'https://your-api.com/endpoint',
            [
                'headers' => $headers,
            ]
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
      
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        
        $content = $response->getContent();
        // $content = '{"id":123, "name":"example", ...}'
        
        $contentArray = $response->toArray();
        // $contentArray = ['id' => 123, 'name' => 'example', ...]

        return $contentArray;
    }
}
