<?php

namespace R4nkt\PhpSdk;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use R4nkt\PhpSdk\Actions\ManagesActions;
use R4nkt\PhpSdk\Actions\ManagesRewards;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class R4nkt
{
    use MakesHttpRequests;
    use ManagesActions;
    use ManagesRewards;

    /** @var string */
    public $apiToken;

    /** @var string */
    public $gameId;

    /** @var \GuzzleHttp\Client */
    public $client;

    /** @var int */
    public $retryAfter;

    public function __construct(string $apiToken, string $gameId, Client $client = null)
    {
        $this->apiToken = $apiToken;
        $this->gameId = $gameId;

        $this->client = $client ?: $this->defaultClient();
    }

    protected function transformCollection(array $collection, string $class): array
    {
        return array_map(function ($attributes) use ($class) {
            return new $class($attributes, $this);
        }, $collection);
    }

    protected function defaultClient()
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->push(Middleware::retry($this->retryDecider(), $this->retryDelay()));

        return new Client([
            'base_uri' => "https://r4nkt.com/api/v1/games/{$this->gameId}/",
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'handler' => $handlerStack,
        ]);
    }

    public function retryDecider()
    {
        return function ($retries, Request $request, Response $response = null, RequestException $exception = null) {
            // Limit the number of retries to 5
            if ($retries >= 5) {
                return false;
            }

            // Retry connection exceptions
            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                // Retry on rate limit hits
                if ($response->getStatusCode() == 429) {
                    $this->retryAfter = $response->hasHeader('retry-after') ? $response->getHeader('retry-after')[0] : null;

                    return true;
                }

                // Retry on server errors
                if ($response->getStatusCode() >= 500) {
                    return true;
                }
            }

            return false;
        };
    }

    /**
     * delay 1s 2s 3s 4s 5s.
     *
     * @return Closure
     */
    public function retryDelay()
    {
        return function ($numberOfRetries) {
            return 1000 * ($this->retryAfter ?: $numberOfRetries);
        };
    }
}
