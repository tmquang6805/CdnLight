<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Link extends AbstractHelper
{
    /**
     * Link builder container
     * @var CdnLight\Generator\LinkBuilderContainer
     */
    protected $linkBuilderContainer;
    
    /**
     * Cdn status
     * @var boolean
     */
    protected $disabled;

    public function __construct($linkBuilderContainer, $disabled = false)
    {
        $this->linkBuilderContainer = $linkBuilderContainer;
        $this->disabled = $disabled;
    }

    /**
     * Get cdn link
     * @param string $src
     */
    public function __invoke($src = null)
    {
        return $this->cdn($src);
    }
    
    /**
     * Get cdn link
     * @param string $src
     */
    public function cdn($src)
    {
        if (null === $src) {
            return $this;
        }

        if($this->disabled) {
            return $src;
        }
        
        return $this->linkBuilderContainer->getUri($src);
    }
}
