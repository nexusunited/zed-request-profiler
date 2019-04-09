<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\MessageCollector;

class MessageCollectorContainer
{
    /**
     * @var \NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface|null
     */
    protected static $instance;

    /**
     * @return \NxsSpryker\Yves\ZedRequestProfiler\MessageCollector\MessageCollectorInterface
     */
    public function getMessageCollector(): MessageCollectorInterface
    {
        if (!static::$instance) {
            static::$instance = new MessageCollector();
        }

        return static::$instance;
    }
}
