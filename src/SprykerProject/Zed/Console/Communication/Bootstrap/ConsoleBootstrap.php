<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerProject\Zed\Console\Communication\Bootstrap;

use Spryker\Zed\Console\Business\Model\Environment;
use Spryker\Zed\Console\Communication\Bootstrap\ConsoleBootstrap as SprykerConsoleBootstrap;

/**
 * @method \Spryker\Zed\Console\ConsoleConfig getConfig()
 * @method \Spryker\Zed\Console\Communication\ConsoleCommunicationFactory getFactory()
 * @method \Spryker\Zed\Console\Business\ConsoleFacade getFacade()
 */
class ConsoleBootstrap extends SprykerConsoleBootstrap
{
    /**
     * @param string $name
     * @param string $version
     */
    public function __construct($name = 'Spryker', $version = '1')
    {
        Environment::initialize();

        // Just for booting the Kernel with the right environment and building the container
        new ConsoleKernel('production', false);

        parent::__construct($name, $version);

        $this->setCatchExceptions($this->getConfig()->shouldCatchExceptions());
        $this->addEventDispatcher();
    }
}
