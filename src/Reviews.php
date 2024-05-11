<?php

namespace Designbycode\Reviews;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Reviews
{
    private static ?Client $client = null;

    private string $googleMapsApiKey;

    private string $googleMapsPlaceId;

    public function __construct(string $googleMapsApiKey, string $googleMapsPlaceId)
    {
        $this->googleMapsApiKey = $googleMapsApiKey;
        $this->googleMapsPlaceId = $googleMapsPlaceId;
    }

    private function getClient(): Client
    {
        if (! self::$client) {
            self::$client = new Client();
        }

        return self::$client;
    }

    private function makeRequest(): ResponseInterface
    {
        return $this->getClient()->get('https://maps.googleapis.com/maps/api/place/details/json', [
            'query' => [
                'place_id' => $this->googleMapsPlaceId,
                'key' => $this->googleMapsApiKey,
                'fields' => 'user_ratings_total,rating,reviews',
            ],
        ]);
    }

    public function getReviews(): array
    {
        $response = $this->makeRequest();
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);

            return $responseData['result']['reviews'] ?? [];
        }

        return [];
    }

    public function getRating(): ?float
    {
        $response = $this->makeRequest();
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);

            return $responseData['result']['rating'] ?? null;
        }

        return null;
    }

    public function getUserRatingsTotal(): ?int
    {
        $response = $this->makeRequest();
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);

            return $responseData['result']['user_ratings_total'] ?? null;
        }

        return null;
    }
}
