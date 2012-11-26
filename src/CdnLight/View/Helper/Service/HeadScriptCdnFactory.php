<?php

namespace CdnLight\View\Helper\Service;

use CdnLight\View\Helper\HeadScript;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HeadScriptCdnFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $helper = new HeadScript($config['cdn_light']['servers']);
        return $helper;
    }
}
