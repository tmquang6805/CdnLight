<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use Zend\View\Helper\HeadScript as BaseHeadScript;

class HeadScript extends BaseHeadScript
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

    protected function cdn($value)
    {
        if (!$this->disabled) {
            $value->attributes['src'] = $this->linkBuilderContainer->getUri($value->attributes['src']);
        }
    }
}
