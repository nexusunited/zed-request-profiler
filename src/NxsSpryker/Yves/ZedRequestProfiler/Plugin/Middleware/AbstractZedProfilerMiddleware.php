<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\Plugin\Middleware;

use NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface;
use Spryker\Shared\ZedRequest\Client\Middleware\MiddlewareInterface;

abstract class AbstractZedProfilerMiddleware implements MiddlewareInterface
{
    /**
     * @var \NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface
     */
    private $messageCollector;

    /**
     * @param \NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface $messageCollector
     */
    public function __construct(MessageCollectorInterface $messageCollector)
    {
        $this->messageCollector = $messageCollector;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::class;
    }

    /**
     * @return \NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface
     */
    protected function getMessageCollector(): MessageCollectorInterface
    {
        return $this->messageCollector;
    }
}
