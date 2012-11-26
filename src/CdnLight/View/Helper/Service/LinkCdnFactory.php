<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper\Service;

use CdnLight\View\Helper\Link;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LinkCdnFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $config = $serviceLocator->get('Config');
        $helper = new Link($config['cdn_light']['servers'], $config['cdn_light']['enabled']);
        return $helper;
    }
}
