<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use stdClass;
use Zend\Stdlib\Exception\InvalidArgumentException;
use Zend\Uri\Http as HttpUri;
use Zend\View\Helper\HeadScript as BaseHeadScript;

class HeadScript extends BaseHeadScript
{

    private $linkBuilders;
    private $disabled;

    /**
     * Construct the cdn helper
     *
     * @param array $cdnConfig
     */
    public function __construct($linkBuilders, $disabled = false)
    {
        $this->linkBuilders = $linkBuilders;
        $this->disabled = $disabled;
    }

    /**
     * Override append
     *
     * @param  string $value Append script or file
     * @return void
     */
    public function append($value)
    {
        $this->cdn($value);
        parent::append($value);
    }

    /**
     * Override prepend
     *
     * @param  string $value Prepend script or file
     * @return void
     */
    public function prepend($value)
    {
        $this->cdn($value);
        parent::prepend($value);
    }

    /**
     * Override set
     *
     * @param  string $value Set script or file
     * @return void
     */
    public function set($value)
    {
        $this->cdn($value);
        parent::set($value);
    }

    /**
     * Override offsetSet
     *
     * @param  string|int $index Set script of file offset
     * @param  mixed      $value
     * @return void
     */
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

        return $this;
    }

}
