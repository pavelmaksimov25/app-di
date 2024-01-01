<?php

namespace SprykerProject\Zed\Console\Communication\Bootstrap;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class ConsoleKernel extends Kernel
{
    use MicroKernelTrait;

    /**
     * @return string
     */
    public function getProjectDir(): string
    {
        return APPLICATION_ROOT_DIR;
    }

    public function registerBundles(): iterable
    {
        return [];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // TODO: Implement registerContainerConfiguration() method.
    }
}
