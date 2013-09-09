<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use Zend\View\Helper\HeadScript as BaseHeadScript;

class HeadScript extends BaseHeadScript
{

    private $linkBuilders;
    private $disabled;

    public function __construct($linkBuilders, $disabled = false)
    {
        $this->linkBuilders = $linkBuilders;
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

    private function cdn($value)
    {
        if (!$this->disabled) {
            $value->attributes['src'] = $this->linkBuilders->getUri($value->attributes['src']);
        }
    }

}
