<?php

namespace CdnLight\View\Helper\Service;

use CdnLight\View\Helper\HeadLink;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HeadLinkCdnFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $helper = new HeadLink($config['cdn_light']['servers']);
        return $helper;
    }
}