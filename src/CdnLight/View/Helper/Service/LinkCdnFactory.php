<?php

namespace CdnLight\View\Helper\Service;

use CdnLight\View\Helper\Link;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LinkCdnFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $helper = new Link($config['cdn_light']['servers']);
        return $helper;
    }
}
