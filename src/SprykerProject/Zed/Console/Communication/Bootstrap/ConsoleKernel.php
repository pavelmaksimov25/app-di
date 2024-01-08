<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerProject\Zed\Console\Communication\Bootstrap;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel;

class ConsoleKernel extends Kernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return APPLICATION_ROOT_DIR;
    }
}
