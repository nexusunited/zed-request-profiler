<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\Plugin\Middleware;

use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Spryker\Shared\ZedRequest\Client\AbstractHttpClient;

class ZedRequestProfilerMiddleware extends AbstractZedProfilerMiddleware
{
    /**
     * @return callable
     */
    public function getCallable(): callable
    {
        return Middleware::mapRequest(function (RequestInterface $request) {
            if ($request->hasHeader(AbstractHttpClient::HEADER_HOST_YVES)) {
                $this->getMessageCollector()->addRequest($request);
            }

            return $request;
        });
    }
}
