<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Stdlib\Exception\InvalidArgumentException;
use Zend\Uri\Http as HttpUri;

class Link extends AbstractHelper
{
    /**
     * Enable state
     * @var boolean
     */
    protected $enabled;

    /**
     * Cdn config, array of server config
     * @var array
     */
    protected $cdnConfig;

    /**
     * Current server id used
     * @var integer
     */
    protected static $serverId;

    /**
     * Construct the cdn helper
     *
     * @param array $cdnConfig
     */
    public function __construct(array $cdnConfig, $enabled)
    {
        $this->setCdnConfig($cdnConfig);
        $this->setEnabled($enabled);
    }

    /**
     * Set the Cdn servers config
     *
     * @param array $cdnConfig
     * @return HeadScript
     */
    public function setCdnConfig(array $cdnConfig)
    {
        if(empty($cdnConfig)) {
            throw new InvalidArgumentException('Cdn config must be not empty');
        }
        $configs = array();
        foreach($cdnConfig as $cdn) {
            if(!is_array($cdn)) {
                throw new InvalidArgumentException('Cdn config must be an array of cdn arrays');
            }
            $configs[] = $cdn;
        }
        $this->cdnConfig = $configs;
        static::$serverId = 0;
        return $this;
    }

    /**
     * Get enable state
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set enable state
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Usage of image view helper
     * @param string $src
     * @return Image
     */
    public function __invoke($src = null)
    {
        if(null === $src) {
            return $this;
        }
        return $this->cdn($src);
    }

    /**
     * Get cdn link
     * @param string $src
     */
    public function cdn($src)
    {
        if(!$this->getEnabled()) {
            return $src;
        }
        if(!is_string($src)) {
            throw new InvalidArgumentException('Source image must be a string');
        }
        if(!isset($this->cdnConfig[static::$serverId])) {
            static::$serverId = 0;
        }
        $config = $this->cdnConfig[static::$serverId];
        $uri = new HttpUri($src);
        if($uri->getHost()) {
            return $uri->toString();
        }
        $uri->setScheme($config['scheme']);
        $uri->setPort($config['port']);
        $uri->setHost($config['host']);
        return $uri->toString();
    }
}
