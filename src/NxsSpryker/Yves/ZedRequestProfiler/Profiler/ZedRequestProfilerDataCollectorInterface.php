<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\Profiler;

interface ZedRequestProfilerDataCollectorInterface
{
    /**
     * @return array
     */
    public function getRequests(): array;

    /**
     * @return array
     */
    public function getResponses(): array;
}
