<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\Generator;

use Zend\Uri\Http as HttpUri;

class LinkBuilder
{

    /**
     * Link builder configuration
     * @var array
     */
    protected $configuration;

    public function __construct(array $configuration)
    {
        $this->configuration = array_replace_recursive(
            array('scheme' => '', 'port' => ''), 
            $configuration
        );
    }

    /**
     * 
     * @param string $uri
     * @return string
     */
    public function getUri($uri)
    {
        if ($this->isPassthru()) {
            return $uri;
        }
        
        $httpUri = new HttpUri($uri);
        
        if ($httpUri->getHost()) {
            return $httpUri->toString();
        }

        if ($this->isConfiguredForHost()) {
            $this->build($httpUri);
        }

        $this->getUriWithMTime($httpUri);
        
        $uri = $httpUri->toString();
        
        if ($this->isConfiguredForHost() && $this->isSchemeless()) {
            $uri = substr($uri, strlen("http:"));
        }
        
        return $uri;
    }

    /**
     * Check scheme configuration
     * @return boolean
     */
    protected function isSchemeless()
    {
        return empty($this->configuration['scheme']);
    }

    /**
     * Check CDN status
     * @return boolean
     */
    protected function isPassthru()
    {
        return (isset($this->configuration['passthru']) && $this->configuration['passthru']);
    }

    /**
     * Check CDN configuration
     * @return boolean
     */
    protected function isConfiguredForHost()
    {
        return isset($this->configuration['host']) && !empty($this->configuration['host']);
    }

    /**
     * Build with configuration
     * @param HttpUri $uri
     * @return LinkBuilder
     */
    protected function build(HttpUri $uri)
    {
        $config = $this->configuration;
        
        if ($this->isSchemeless()) {
            $config['scheme'] = "http";
        }
        
        $uri->setScheme($config['scheme']);
        $uri->setPort($config['port']);
        $uri->setHost($config['host']);

        return $this;
    }

    /**
     * Add mktime file as argument
     * @param HttpUri $uri
     * @return LinkBuilder
     */
    protected function getUriWithMTime(HttpUri $uri)
    {
        if (isset($this->configuration['assetMTimePath']) && file_exists($this->configuration['assetMTimePath'])) {
            $query = $uri->getQueryAsArray();
            $query['m'] = filemtime($this->configuration['assetMTimePath']);
            $uri->setQuery($query);
        }
        
        return $this;
    }

}
