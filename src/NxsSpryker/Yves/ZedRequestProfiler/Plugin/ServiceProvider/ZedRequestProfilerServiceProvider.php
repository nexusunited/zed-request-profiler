<?php

namespace NxsSpryker\Yves\ZedRequestProfiler\Plugin\ServiceProvider;

use NxsSpryker\Yves\ZedRequestProfiler\Profiler\ZedRequestProfilerDataCollector;
use RuntimeException;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Shared\Twig\TwigFilesystemLoader;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \NxsSpryker\Yves\ZedRequestProfiler\ZedRequestProfilerFactory getFactory()
 * @method \NxsSpryker\Yves\ZedRequestProfiler\ZedRequestProfilerConfig getConfig()
 */
class ZedRequestProfilerServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function register(Application $app): void
    {
        if (!$this->isWebProfilerEnabled()) {
            return;
        }

        $this
            ->extendDataCollectors($app)
            ->extendDataCollectorTemplates($app)
            ->extendTwigLoader($app);
    }

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function boot(Application $app): void
    {
        if (!$this->isWebProfilerEnabled()) {
            return;
        }

        $this->addGuzzleMiddleware();
    }

    /**
     * @return bool
     */
    protected function isWebProfilerEnabled(): bool
    {
        return $this->getConfig()->isWebProfilerEnabled();
    }

    /**
     * @param \Silex\Application $app
     *
     * @return $this
     */
    protected function extendDataCollectors(Application $app)
    {
        $app->extend('data_collectors', function (array $collectors) {
            return $this->addZedRequestProfilerDataCollector($collectors);
        });

        return $this;
    }

    /**
     * @param array $collectors
     *
     * @return array
     */
    protected function addZedRequestProfilerDataCollector(array $collectors): array
    {
        $collectors[ZedRequestProfilerDataCollector::NAME] = function () {
            return $this->getFactory()->createZedRequestProfilerDataCollector();
        };

        return $collectors;
    }

    /**
     * @param \Silex\Application $app
     *
     * @return $this
     */
    protected function extendDataCollectorTemplates(Application $app)
    {
        $app['data_collector.templates'] = $app->extend('data_collector.templates', function ($templates) {
            return $this->addZedRequestProfilerDataCollectorTemplate($templates);
        });

        return $this;
    }

    /**
     * @param array $templates
     *
     * @return array
     */
    protected function addZedRequestProfilerDataCollectorTemplate(array $templates): array
    {
        $templates[] = [ZedRequestProfilerDataCollector::NAME, $this->getTemplateName()];

        return $templates;
    }

    /**
     * @return string
     */
    protected function getTemplateName(): string
    {
        return '@ZedRequestProfiler/collector/profiler.html.twig';
    }

    /**
     * @param \Silex\Application $app
     *
     * @return $this
     */
    protected function extendTwigLoader(Application $app)
    {
        $loaderKey = $this->getLoaderKey();
        $app[$loaderKey] = $app->extend($loaderKey, function (TwigFilesystemLoader $loader) {
            if (!method_exists($loader, 'addPath')) {
                return $loader;
            }

            $pathToTemplates = $this->getPathToTemplates();
            $loader->addPath($pathToTemplates);

            return $loader;
        });

        return $this;
    }

    /**
     * @return string
     */
    protected function getLoaderKey(): string
    {
        return sprintf('twig.loader.%s', strtolower(APPLICATION));
    }

    /**
     * @throws \RuntimeException
     *
     * @return string
     */
    protected function getPathToTemplates(): string
    {
        $result = realpath(dirname(__DIR__) . '/../Theme/default');

        if ($result === false) {
            throw new RuntimeException('Can not find template path!');
        }

        return $result;
    }

    /**
     * @return void
     */
    protected function addGuzzleMiddleware(): void
    {
        $handlerStackContainer = $this->getFactory()->createHandlerStackContainer();

        $handlerStackContainer->addMiddleware($this->getFactory()->createZedRequestProfilerMiddleware());
        $handlerStackContainer->addMiddleware($this->getFactory()->createZedResponseProfilerMiddleware());
    }
}
