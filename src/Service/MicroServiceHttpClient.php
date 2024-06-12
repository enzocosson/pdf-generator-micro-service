<?php
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MicroServiceHttpClient
{
    private HttpClientInterface $httpClient;
    private string $accessToken;

    public function __construct(HttpClientInterface $httpClient, string $accessToken)
    {
        $this->httpClient = $httpClient;
        $this->accessToken = $accessToken;
    }

    public function fetchDataFromMicroService(): array
    {
        // Définir les options de requête
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken, // Utilisation du jeton d'accès fourni
                'Content-Type' => 'application/json',
            ],
            // Ajouter d'autres options de requête si nécessaire
        ];

        try {
            // Effectuer une requête POST avec les options spécifiées
            $response = $this->httpClient->request('POST', 'https://your-microservice-api.com/endpoint', $options);

            // Vérifier le code de statut de la réponse
            if ($response->getStatusCode() === 200) {
                // Récupérer le contenu de la réponse
                $content = $response->toArray();

                return $content;
            } else {
                // Gérer les erreurs HTTP ici
                throw new \Exception('Unexpected HTTP status code: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Gérer les exceptions ici
            throw $e;
        }
    }
}
