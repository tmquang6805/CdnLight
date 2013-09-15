<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\Generator;

class LinkBuilderContainer
{
    /**
     * LinkBuilder container
     * @var array
     */
    protected $container;

    public function __construct(array $container)
    {
        $this->container = $container;
    }

    /**
     * Get a formatted uri
     * @param string $input
     * @return string
     */
    public function getUri($input)
    {
        $current = array_shift($this->container);
        $uri = $current->getUri($input);
        array_push($this->container, $current);

        return $uri;
    }

}
