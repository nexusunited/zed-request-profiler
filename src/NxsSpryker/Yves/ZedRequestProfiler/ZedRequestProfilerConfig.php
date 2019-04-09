<?php

namespace NxsSpryker\Yves\ZedRequestProfiler;

use Spryker\Shared\Config\ConfigConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class ZedRequestProfilerConfig extends AbstractBundleConfig
{
    /**
     * @return bool
     */
    public function isWebProfilerEnabled(): bool
    {
        return $this->get(ConfigConstants::ENABLE_WEB_PROFILER, false);
    }
}
