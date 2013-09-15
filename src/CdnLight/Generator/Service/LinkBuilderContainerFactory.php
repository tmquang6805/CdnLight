<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\Generator\Service;

use CdnLight\Generator\LinkBuilder;
use CdnLight\Generator\LinkBuilderContainer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LinkBuilderContainerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $builders = array();
        $config = $serviceLocator->get('Config');
        foreach ($config['cdn_light']['servers'] as $server) {
            $builders[] = new LinkBuilder(
                            array_merge($config['cdn_light']['global'], $server)
                          );
        }
        return new LinkBuilderContainer($builders);
    }
}
