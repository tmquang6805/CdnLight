<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper\Service;

use CdnLight\View\Helper\HeadLink;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HeadLinkCdnFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('Config');
        $builder = $serviceLocator->getServiceLocator()->get('cdnLinkBuilderContainer');
        $disabled = isset($config['cdn_light']['head_link']) && !$config['cdn_light']['head_link'];

        return new HeadLink($builder, $disabled);
    }
}
