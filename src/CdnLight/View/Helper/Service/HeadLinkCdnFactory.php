<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper\Service;

use CdnLight\View\Helper\HeadLink;
use Zend\ServiceManager\ServiceLocatorInterface;

class HeadLinkCdnFactory extends AbstractLinkBuilderFactory
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $helper = new HeadLink($this->getLinkBuilders(), $this->isDisabled('HeadLink'));
        return $helper;
    }

}
