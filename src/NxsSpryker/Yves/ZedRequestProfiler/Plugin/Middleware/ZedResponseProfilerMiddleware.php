<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\Plugin\Middleware;

use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;
use Spryker\Shared\ZedRequest\Client\AbstractHttpClient;

class ZedResponseProfilerMiddleware extends AbstractZedProfilerMiddleware
{
    /**
     * @return callable
     */
    public function getCallable(): callable
    {
        return Middleware::mapResponse(
            function (ResponseInterface $response) {
                if ($response->hasHeader(AbstractHttpClient::HEADER_HOST_ZED)) {
                    $this->getMessageCollector()->addResponse($response);
                }

                return $response;
            }
        );
    }
}
