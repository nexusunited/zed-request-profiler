<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\Profiler;

use Exception;
use NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class ZedRequestProfilerDataCollector implements DataCollectorInterface, ZedRequestProfilerDataCollectorInterface
{
    public const NAME = 'ZED_REQUEST_PROFILER_COLLECTOR';

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
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     * @param \Exception|null $exception
     *
     * @return void
     */
    public function collect(Request $request, Response $response, ?Exception $exception = null): void
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return array
     */
    public function getRequests(): array
    {
        return $this->messageCollector->getRequests();
    }

    /**
     * @return array
     */
    public function getResponses(): array
    {
        return $this->messageCollector->getResponses();
    }
}
