<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\MessageCollector;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface MessageCollectorInterface
{
    /**
     * @return array
     */
    public function getRequests(): array;

    /**
     * @return array
     */
    public function getResponses(): array;

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return void
     */
    public function addRequest(RequestInterface $request): void;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return void
     */
    public function addResponse(ResponseInterface $response): void;
}
