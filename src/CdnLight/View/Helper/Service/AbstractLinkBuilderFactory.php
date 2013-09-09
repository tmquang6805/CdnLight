<?php

namespace CdnLight\View\Helper\Service;

use Zend\ServiceManager\FactoryInterface;
use CdnLight\Generator\LinkBuilder;
use CdnLight\Generator\LinkBuilders;

abstract class AbstractLinkBuilderFactory implements FactoryInterface
{

    protected $serviceLocator;

    protected function getLinkBuilders()
    {
        $serviceLocator = $this->serviceLocator->getServiceLocator();
        $config = $this->serviceLocator->get('Config');

        $builders = array();

        foreach ($config['cdn_light']['servers'] as $server) {
            $builders[] = new LinkBuilder(array_merge($config['cdn_light']['global'], $server));
        }

        return new LinkBuilders($builders);
    }

    protected function isDisabled($type)
    {
        $serviceLocator = $this->serviceLocator->getServiceLocator();
        $config = $serviceLocator->get('Config');
        $disabled = false;

        if (isset($config['cdn_light'][$type]) && !$config['cdn_light'][$type]) {
            $disabled = true;
        }

        return $disabled;
    }

}