<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\Generator;

class LinkBuilderContainer
{

    private $linkBuilders;

    public function __construct($linkBuilders)
    {
        $this->linkBuilders = $linkBuilders;
    }

    public function getUri($input)
    {
        $current = array_shift($this->linkBuilders);
        $uri = $current->getUri($input);
        array_push($this->linkBuilders, $current);

        return $uri;
    }

}