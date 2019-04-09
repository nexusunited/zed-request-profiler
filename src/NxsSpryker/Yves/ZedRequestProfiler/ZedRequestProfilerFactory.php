<?php

namespace NxsSpryker\Yves\ZedRequestProfiler;

use NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorContainer;
use NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface;
use NxsSpryker\Yves\ZedRequestProfiler\Plugin\Middleware\ZedRequestProfilerMiddleware;
use NxsSpryker\Yves\ZedRequestProfiler\Plugin\Middleware\ZedResponseProfilerMiddleware;
use NxsSpryker\Yves\ZedRequestProfiler\Profiler\ZedRequestProfilerDataCollector;
use Spryker\Shared\ZedRequest\Client\HandlerStack\HandlerStackContainer;
use Spryker\Yves\Kernel\AbstractFactory;

class ZedRequestProfilerFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Shared\ZedRequest\Client\HandlerStack\HandlerStackContainer
     */
    public function createHandlerStackContainer(): HandlerStackContainer
    {
        return new HandlerStackContainer();
    }

    /**
     * @return \NxsSpryker\Yves\ZedRequestProfiler\Plugin\Middleware\ZedRequestProfilerMiddleware
     */
    public function createZedRequestProfilerMiddleware(): ZedRequestProfilerMiddleware
    {
        return new ZedRequestProfilerMiddleware(
            $this->getMessageCollector()
        );
    }

    /**
     * @return \NxsSpryker\Yves\ZedRequestProfiler\Plugin\Middleware\ZedResponseProfilerMiddleware
     */
    public function createZedResponseProfilerMiddleware(): ZedResponseProfilerMiddleware
    {
        return new ZedResponseProfilerMiddleware(
            $this->getMessageCollector()
        );
    }

    /**
     * @return \NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface
     */
    public function getMessageCollector(): MessageCollectorInterface
    {
        return $this->createMessageCollectorContainer()->getMessageCollector();
    }

    /**
     * @return \NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorContainer
     */
    public function createMessageCollectorContainer(): MessageCollectorContainer
    {
        return new MessageCollectorContainer();
    }

    /**
     * @return \NxsSpryker\Yves\ZedRequestProfiler\Profiler\ZedRequestProfilerDataCollector
     */
    public function createZedRequestProfilerDataCollector(): ZedRequestProfilerDataCollector
    {
        return new ZedRequestProfilerDataCollector(
            $this->getMessageCollector()
        );
    }
}
