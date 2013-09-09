<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Link extends AbstractHelper
{

    private $linkBuilders;
    private $disabled;

    public function __construct($linkBuilders, $disabled = false)
    {
        $this->linkBuilders = $linkBuilders;
        $this->disabled = $disabled;
    }

    public function __invoke($src = null)
    {
        if (null === $src) {
            return $this;
        }

        if($this->disabled) {
            return $src;
        }
        
        return $this->linkBuilders->getUri($src);
    }

}
