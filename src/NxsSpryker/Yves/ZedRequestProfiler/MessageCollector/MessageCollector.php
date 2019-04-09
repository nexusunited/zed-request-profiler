<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\MessageCollector;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function json_decode;

class MessageCollector implements MessageCollectorInterface
{
    /**
     * @var array
     */
    private $requests = [];

    /**
     * @var array
     */
    private $responses = [];

    /**
     * @return array
     */
    public function getRequests(): array
    {
        return $this->requests;
    }

    /**
     * @return array
     */
    public function getResponses(): array
    {
        return $this->responses;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return void
     */
    public function addRequest(RequestInterface $request): void
    {
        $body = $request->getBody();
        $body->rewind();

        $this->requests[] = [
            'request' => $request,
            'contents' => json_decode($body->getContents(), true),
        ];
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return void
     */
    public function addResponse(ResponseInterface $response): void
    {
        $body = $response->getBody();
        $body->rewind();

        $this->responses[] = [
            'response' => $response,
            'contents' => json_decode($body->getContents(), true),
        ];
    }
}
