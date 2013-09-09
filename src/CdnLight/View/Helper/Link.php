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

    /**
     * Construct the cdn helper
     *
     * @param array $cdnConfig
     */
    public function __construct($linkBuilders)
    {
        $this->linkBuilders = $linkBuilders;
    }

    /**
     * Usage of image view helper
     * @param string $src
     * @return Image
     */
    public function __invoke($src = null)
    {
        if (null === $src) {
            return $this;
        }

        return $this->linkBuilders->getUri($src);
    }

}
