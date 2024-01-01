<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerProject\Zed\Console\Communication\Bootstrap;

use Spryker\Zed\Console\Business\Model\Environment;
use Symfony\Bundle\FrameworkBundle\Console\Application;

/**
 * @method \Spryker\Zed\Console\ConsoleConfig getConfig()
 * @method \Spryker\Zed\Console\Communication\ConsoleCommunicationFactory getFactory()
 * @method \Spryker\Zed\Console\Business\ConsoleFacade getFacade()
 */
class ConsoleBootstrap extends \Spryker\Zed\Console\Communication\Bootstrap\ConsoleBootstrap
{
    /**
     * @param string $name
     * @param string $version
     */
    public function __construct($name = 'Spryker', $version = '1')
    {
        Environment::initialize();

        parent::__construct(new ConsoleKernel('production', false));

        $this->setCatchExceptions($this->getConfig()->shouldCatchExceptions());
        $this->addEventDispatcher();
    }
}
