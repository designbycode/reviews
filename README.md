# Google Reviews

[![Latest Version on Packagist](https://img.shields.io/packagist/v/designbycode/reviews.svg?style=flat-square)](https://packagist.org/packages/designbycode/reviews)
[![Tests](https://img.shields.io/github/actions/workflow/status/designbycode/reviews/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/designbycode/reviews/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/designbycode/reviews.svg?style=flat-square)](https://packagist.org/packages/designbycode/reviews)

The Reviews class is a part of the Designbycode namespace and is used to fetch reviews, rating, and user ratings total of a place using the Google Places API. It requires a Google Maps API key and a Google Maps place ID to make requests.



## Installation

You can install the package via composer:

```bash
composer require designbycode/reviews
```

## Usage
To use the Reviews class, you need to initialize it with a Google Maps API key and a Google Maps place ID. Here's an example:

```php
$reviews = new Designbycode\Reviews\Reviews('YOUR_GOOGLE_MAPS_API_KEY', 'YOUR_GOOGLE_MAPS_PLACE_ID');

$reviewsArray = $reviews->getReviews();
$rating = $reviews->getRating();
$userRatingsTotal = $reviews->getUserRatingsTotal();
```
Replace `YOUR_GOOGLE_MAPS_API_KEY` and `YOUR_GOOGLE_MAPS_PLACE_ID` with your actual Google Maps API key and place ID. The getReviews, getRating, and getUserRatingsTotal methods return the reviews, rating, and user ratings total of 
the place, respectively.



## Properties
The class has the following properties:

- $googleMapsApiKey: A string that holds the Google Maps API key.
- $googleMapsPlaceId: A string that holds the Google Maps place ID.
- $client: A Guzzle HTTP client object used to make requests.

## Methods
The class has the following methods:

### __construct(string $googleMapsApiKey, string $googleMapsPlaceId)
The constructor initializes the `$googleMapsApiKey` and `$googleMapsPlaceId` properties.

### getClient(): Client
The `getClient` method returns a Guzzle HTTP client object. If the client object is not initialized, it creates a new one.

### makeRequest(): ResponseInterface
The `makeRequest` method makes a GET request to the Google Places API to fetch the details of the place. It takes the $googleMapsPlaceId and $googleMapsApiKey properties as query parameters.

### getReviews(): array
The `getReviews` method returns an array of reviews of the place. It first makes a request to the Google Places API using the makeRequest method. If the response status code is 200, it decodes the JSON response and returns the reviews field. If the response status code is not 200, it returns an empty array.

### getRating(): ?float
The `getRating` method returns the rating of the place as a float. It first makes a request to the Google Places API using the makeRequest method. If the response status code is 200, it decodes the JSON response and returns the rating field. If the response status code is not 200, it returns null.

### getUserRatingsTotal(): ?int
The `getUserRatingsTotal` method returns the total number of user ratings of the place as an integer. It first makes a request to the Google Places API using the makeRequest method. If the response status code is 200, it decodes the JSON response and returns the user_ratings_total field. If the response status code is not 200, it returns null.

## Google API Rate limit
Yes, there are rate limits and quotas on Google Places API requests. According to the Google Places API documentation, the free tier of the Google Places API allows for up to 150,000 free requests per day, with a limit of 50 requests per second. If you exceed these limits, you will receive a 403 INSUFFICIENT_TOKENS error response.

If you need to make more requests than the free tier allows, you can upgrade to a paid plan, which offers higher rate limits and quotas. The pricing for the paid plans is based on the number of requests and the level of support you need.

It's important to note that Google also has usage limits for the Google Maps APIs as a whole, which include the Places API. The free tier of the Google Maps APIs allows for up to 25,000 free requests per day, with a limit of 1 request per second. If you exceed these limits, you will receive a 403 DAILY_LIMIT_EXCEEDED error response.

To avoid hitting the rate limits and quotas, you can implement caching mechanisms to store the results of your API requests and reuse them for subsequent requests. You can also use the fields parameter in your API requests to only request the data that you need, which can help reduce the number of requests you make.In summary, the Google Places API has rate limits and quotas that you should be aware of when using the API. You can upgrade to a paid plan if you need to make more requests than the free tier allows, and you can implement caching mechanisms and use the fields parameter to optimize your API usage.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [claudemyburgh](https://github.com/designbycode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
