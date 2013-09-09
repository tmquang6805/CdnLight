<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use stdClass;
use Zend\Stdlib\Exception\InvalidArgumentException;
use Zend\Uri\Http as HttpUri;
use Zend\View\Helper\HeadLink as BaseHeadLink;

class HeadLink extends BaseHeadLink
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
     * append()
     *
     * @param  array $value
     * @return void
     * @throws Exception\InvalidArgumentException
     */
    public function append($value)
    {
        $this->cdn($value);
        parent::append($value);
    }

    /**
     * prepend()
     *
     * @param  array $value
     * @return HeadLink
     * @throws Exception\InvalidArgumentException
     */
    public function prepend($value)
    {
        $this->cdn($value);
        parent::prepend($value);
    }

    /**
     * set()
     *
     * @param  array $value
     * @return HeadLink
     * @throws Exception\InvalidArgumentException
     */
    public function set($value)
    {
        $this->cdn($value);
        parent::set($value);
    }

    /**
     * offsetSet()
     *
     * @param  string|int $index
     * @param  array $value
     * @return void
     * @throws Exception\InvalidArgumentException
     */
    public function offsetSet($index, $value)
    {
        $this->cdn($value);
        parent::offsetSet($index, $value);
    }

    /**
     * Construct the cdn url
     * @param \StdClass $value
     * @return HeadScript
     */
    protected function cdn(\StdClass $value)
    {
        if (!$this->disabled) {
            $value->href = $this->linkBuilders->getUri($value->href);
        }

        return $this;
    }

}
