<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerProject\Shared\Application;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class ApplicationKernel extends Kernel implements CompilerPassInterface
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return APPLICATION_ROOT_DIR;
    }

    /**
     * @return void
     */
    public function process(ContainerBuilder $containerBuilder): void
    {
        foreach ($containerBuilder->getDefinitions() as $definition) {
            $class = $definition->getClass();
            if (str_ends_with($class, 'Controller')) {
                $definition->setPublic(true);
            }
        }
    }
}
