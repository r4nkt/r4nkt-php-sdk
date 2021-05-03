<?php

namespace R4nkt\PhpSdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use R4nkt\PhpSdk\Actions\ManagesAchievements;
use R4nkt\PhpSdk\Actions\ManagesActions;
use R4nkt\PhpSdk\Actions\ManagesActivities;
use R4nkt\PhpSdk\Actions\ManagesBadges;
use R4nkt\PhpSdk\Actions\ManagesCriteria;
use R4nkt\PhpSdk\Actions\ManagesCriteriaGroups;
use R4nkt\PhpSdk\Actions\ManagesLeaderboards;
use R4nkt\PhpSdk\Actions\ManagesPlayers;
use R4nkt\PhpSdk\Actions\ManagesRankings;
use R4nkt\PhpSdk\Actions\ManagesRewards;
use R4nkt\PhpSdk\Resources\ApiResourceCollection;

class R4nkt
{
    use MakesHttpRequests;
    use ManagesAchievements;
    use ManagesActions;
    use ManagesActivities;
    use ManagesBadges;
    use ManagesCriteria;
    use ManagesCriteriaGroups;
    use ManagesLeaderboards;
    use ManagesPlayers;
    use ManagesRankings;
    use ManagesRewards;

    public string $url;

    public string $apiToken;

    public string $gameId;

    public Client $client;

    public ?int $retryAfter;

    public function __construct(string $url, string $apiToken, string $gameId, Client $client = null)
    {
        $this->url = $url;
        $this->apiToken = $apiToken;
        $this->gameId = $gameId;

        $this->client = $client ?: $this->defaultClient();
    }

    protected function buildCollection(array $response, string $resourceClass): ApiResourceCollection
    {
        $collection = $this->transformCollection(
            $response['data'],
            $resourceClass
        );

        return new ApiResourceCollection($collection, $response['meta'] ?? [], $this);
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
            'base_uri' => $this->url . "/v1/games/{$this->gameId}/",
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'handler' => $handlerStack,
        ]);
    }

    public function retryDecider()
    {
        /**
         * The variable, $_request, is not used, but is required. As such, it's
         * suppressed per:
         *  - https://psalm.dev/docs/running_psalm/issues/UnusedClosureParam
         */
        return function ($retries, Request $_request, Response $response = null, TransferException $exception = null) {
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
                    $this->retryAfter = (int) $response->hasHeader('retry-after') ? (int) $response->getHeader('retry-after')[0] : null;

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
     */
    public function retryDelay()
    {
        return function ($numberOfRetries) {
            return 1000 * ($this->retryAfter ?: $numberOfRetries);
        };
    }
}
