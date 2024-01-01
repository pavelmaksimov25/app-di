<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerProject\Shared\Application;

use Spryker\Service\Container\Container;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface;
use Spryker\Shared\ApplicationExtension\Dependency\Plugin\BootableApplicationPluginInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\Routing\Loader\ClosureLoader;
use Symfony\Component\Routing\Router;

class Application extends \Spryker\Shared\Application\Application
{
    /**
     * @var \Spryker\Shared\Application\ApplicationKernel|null
     */
    protected ?\Spryker\Shared\Application\ApplicationKernel $kernel = null;

    /**
     * @param \Spryker\Service\Container\ContainerInterface|null $container
     * @param array<\Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface> $applicationPlugins
     */
    public function __construct(?ContainerInterface $container = null, array $applicationPlugins = [])
    {
        parent::__construct();

        $this->kernel = new \Spryker\Shared\Application\ApplicationKernel('development', true);

        if ($container === null) {
            $container = new Container();
        }

        $this->container = $container;
        $this->enableHttpMethodParameterOverride();

        foreach ($applicationPlugins as $applicationPlugin) {
            $this->registerApplicationPlugin($applicationPlugin);
        }
    }

    /**
     * @return $this
     */
    public function boot()
    {
        if (!$this->booted) {
            $this->kernel->boot();

            $this->container->set('symfony-container', $this->kernel->getContainer());

            $this->booted = true;
            $this->bootPlugins();
        }

        return $this;
    }
}
