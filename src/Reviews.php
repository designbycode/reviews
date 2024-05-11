<?php

    namespace Designbycode\Reviews;

    use GuzzleHttp\Client;

    class Reviews {

        private static ?Client $client = null;

        public function __construct(public string $googleMapsApiKey, public string $googleMapsPlaceId)
        {
        }

        private function request(): \Psr\Http\Message\ResponseInterface
        {
            if (!self::$client) self::$client = new Client();
            return self::$client->get('https://maps.googleapis.com/maps/api/place/details/json', [
                'query' => [
                    'place_id' => $this->googleMapsPlaceId,
                    'key' => $this->googleMapsApiKey,
                    'fields' => 'user_ratings_total,rating,reviews',
                ]
            ]);
        }

        public static function get(string $googleMapsApiKey, string $googleMapsPlaceId): array
        {
            $response = json_decode((new self($googleMapsApiKey, $googleMapsPlaceId))->request()->getBody(), true);
            return $response['result'] ?? [];
        }

        private static function getStatusCode(string $googleMapsApiKey, string $googleMapsPlaceId): int
        {
            return (new self($googleMapsApiKey, $googleMapsPlaceId))->request()->getStatusCode();
        }

    }
