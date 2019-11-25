<?php

namespace R4nkt\PhpSdk;

use Exception;
use Psr\Http\Message\ResponseInterface;
use R4nkt\PhpSdk\Exceptions\FailedActionException;
use R4nkt\PhpSdk\Exceptions\NotFoundException;
use R4nkt\PhpSdk\Exceptions\ValidationException;

trait MakesHttpRequests
{
    /**
     * @param  string $uri
     *
     * @return mixed
     */
    protected function get(string $uri)
    {
        return $this->request('GET', $uri);
    }

    /**
     * @param  string $uri
     * @param  array $payload
     *
     * @return mixed
     */
    protected function post(string $uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * @param  string $uri
     * @param  array $payload
     *
     * @return mixed
     */
    protected function put(string $uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * @param  string $uri
     * @param  array $payload
     *
     * @return mixed
     */
    protected function delete(string $uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * @param  string $verb
     * @param  string $uri
     * @param  array $payload
     *
     * @return mixed
     */
    protected function request(string $verb, string $uri, array $payload = [])
    {
        $response = $this->client->request($verb, $uri,
            empty($payload) ? [] : ['form_params' => $payload]
        );

        if (! $this->isSuccessFul($response)) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    public function isSuccessFul($response): bool
    {
        if (! $response) {
            return false;
        }

        return (int) substr($response->getStatusCode(), 0, 1) === 2;
    }

    protected function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() === 422) {
            throw new ValidationException(json_decode((string) $response->getBody(), true));
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() === 400) {
            throw new FailedActionException((string) $response->getBody());
        }

        throw new Exception((string) $response->getBody());
    }
}
