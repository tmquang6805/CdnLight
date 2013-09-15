<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use Zend\View\Helper\HeadLink as BaseHeadLink;

class HeadLink extends BaseHeadLink
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

    public function append($value)
    {
        $this->cdn($value);
        parent::append($value);
    }

    public function prepend($value)
    {
        $this->cdn($value);
        parent::prepend($value);
    }

    public function set($value)
    {
        $this->cdn($value);
        parent::set($value);
    }

    public function offsetSet($index, $value)
    {
        $this->cdn($value);
        parent::offsetSet($index, $value);
    }

    protected function cdn(\StdClass $value)
    {
        if (!$this->disabled) {
            $value->href = $this->linkBuilderContainer->getUri($value->href);
        }
    }
}
