# Zed Request Profiler

View Zed Requests in Web Debug Toolbar

## Installation

Install the package:
```bash
composer require nxsspryker/zed-request-profiler
```

Register the service provider in `Pyz\Yves\ShopApplication\YvesBootstrap`:
```php
<?php

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\ZedRequestProfiler\Plugin\ServiceProvider\ZedRequestProfilerServiceProvider;
use \SprykerShop\Yves\ShopApplication\YvesBootstrap as SprykerYvesBootstrap;

class YvesBootstrap extends SprykerYvesBootstrap
{
    /**
     * @return void
     */
    protected function registerServiceProviders()
    {
        // ...
        $this->application->register(new ZedRequestProfilerServiceProvider());
    }
}
```

Note: functionality provided by this bundle works only if the Web Profiler is enabled:
```php
<?php

use \Spryker\Shared\Config\ConfigConstants;

$config[ConfigConstants::ENABLE_WEB_PROFILER] = true;
```
