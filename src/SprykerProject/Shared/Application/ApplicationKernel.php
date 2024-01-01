<?php

namespace SprykerProject\Shared\Application;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class ApplicationKernel extends Kernel implements CompilerPassInterface
{
    use MicroKernelTrait;

    /**
     * @return string
     */
    public function getProjectDir(): string
    {
        return \Spryker\Shared\Application\APPLICATION_ROOT_DIR;
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        foreach ($container->getDefinitions() as $definition) {
            $class = $definition->getClass();
            if (str_ends_with($class, 'Controller')) {
                $definition->setPublic(true);
            }
        }
    }
}
