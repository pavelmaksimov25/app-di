<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerProject\Shared\Router\Resolver;

use Symfony\Component\HttpFoundation\Request;

class ControllerResolver extends \Spryker\Shared\Router\Resolver\ControllerResolver
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param array $controller
     *
     * @return callable
     */
    protected function getControllerFromArray(Request $request, array $controller)
    {
        $symfonyContainer = $this->container->get('symfony-container');

        if ($symfonyContainer->has($controller[0])) {
            return [$symfonyContainer->get($controller[0]), $controller[1]];
        }

        if (is_callable($controller[0])) {
            $symfonyContainer = $this->container->get('symfony-container');

            if ($symfonyContainer->has($controller[0])) {
                return $symfonyContainer->get($controller[0]);
            }

            $controllerInstance = $controller[0]();
            $controllerInstance = $this->injectContainerAndInitialize($controllerInstance);

            /** @phpstan-var callable $callable*/
            $callable = [$controllerInstance, $controller[1]];

            return $callable;
        }

        $controllerInstance = new $controller[0]();
        $controllerInstance = $this->injectContainerAndInitialize($controllerInstance);

        /** @phpstan-var callable $callable*/
        $callable = [$controllerInstance, $controller[1]];

        return $callable;
    }
}
