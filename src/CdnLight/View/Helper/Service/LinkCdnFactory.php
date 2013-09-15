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
        $config = $serviceLocator->getServiceLocator()->get('Config');
        $builder = $serviceLocator->getServiceLocator()->get('cdnLinkBuilderContainer');
        $disabled = isset($config['cdn_light']['link_cdn']) && !$config['cdn_light']['link_cdn'];

        return new Link($builder, $disabled);
    }
}
