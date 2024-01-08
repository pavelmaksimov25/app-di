<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerProject\Shared\Application;

use Spryker\Service\Container\Container;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\Application\Application as SprykerApplication;

class Application extends SprykerApplication
{
    protected ?\SprykerProject\Shared\Application\ApplicationKernel $kernel = null;

    /**
     * @param \Spryker\Service\Container\ContainerInterface|null $container
     * @param array<\Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface> $applicationPlugins
     */
    public function __construct(?ContainerInterface $container = null, array $applicationPlugins = [])
    {
        parent::__construct();

        $this->kernel = new ApplicationKernel('development', true);

        if (!$container instanceof ContainerInterface) {
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
