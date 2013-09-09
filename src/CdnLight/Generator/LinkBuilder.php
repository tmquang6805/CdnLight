<?php

/*
 * This file is part of the CdnLight package.
 * @copyright Copyright (c) 2012 Blanchon Vincent - France (http://developpeur-zend-framework.fr - blanchon.vincent@gmail.com)
 */

namespace CdnLight\Generator;

use Zend\Uri\Http as HttpUri;

class LinkBuilder
{

    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function getUri($uri)
    {
        if ($this->isPassthru() || $this->hasHost($uri)) {
            return $uri;
        }

        if ($this->isConfiguredForHost()) {
            $uri = $this->getUriWithHost($uri);

            if ($this->isSchemeless()) {
                $uri = substr($uri, strlen("http:"));
            }
        }

        $uri = $this->getUriWithMTime($uri);

        return $uri;
    }

    private function isSchemeless()
    {
        if (empty($this->configuration['scheme'])) {
            return true;
        }

        return false;
    }

    private function isPassthru()
    {
        return (isset($this->configuration['passthru']) && $this->configuration['passthru']);
    }

    private function hasHost($uri)
    {
        $uri = new HttpUri($uri);

        if ($uri->getHost()) {
            return true;
        }

        return false;
    }

    private function isConfiguredForHost()
    {
        foreach (array('scheme', 'port', 'host') as $key) {
            if (!isset($this->configuration[$key])) {
                return false;
            }
        }

        return true;
    }

    private function getUriWithHost($uri)
    {
        $config = $this->configuration;

        if ($this->isSchemeless()) {
            $config['scheme'] = "http";
        }

        $parsedUri = new HttpUri($uri);
        $parsedUri->setScheme($config['scheme']);
        $parsedUri->setPort($config['port']);
        $parsedUri->setHost($config['host']);

        return $parsedUri->toString();
    }

    private function getUriWithMTime($uri)
    {
        if (isset($this->configuration['assetMTimePath']) && file_exists($this->configuration['assetMTimePath'])) {
            $mtime = filemtime($this->configuration['assetMTimePath']);

            $parsedUrl = parse_url($uri);
            $rebuiltUrl = "";

            if (isset($parsedUrl['scheme'])) {
                $rebuiltUrl .= $parsedUrl['scheme'] . "://";
            } elseif (isset($parsedUrl['host'])) {
                $rebuiltUrl .= "//";
            }

            if (isset($parsedUrl['host']) && (isset($parsedUrl['user']) && isset($parsedUrl['pass']))) {


                $rebuiltUrl .= $parsedUrl['user'] . ":" . $parsedUrl['pass'] . "@";
            }

            if (isset($parsedUrl['host'])) {
                $rebuiltUrl .= $parsedUrl['host'];
            }

            if (isset($parsedUrl['path'])) {
                $rebuiltUrl .= $parsedUrl['path'];
            }



            if (isset($parsedUrl['query'])) {
                $query = explode("&", $parsedUrl['query']);
            } else {
                $query = array();
            }

            $query[] = "m=" . $mtime;

            $rebuiltUrl .= "?" . implode("&", $query);

            if (isset($parsedUrl['fragment'])) {
                $rebuiltUrl .= "#" . $parsedUrl['fragment'];
            }

            return $rebuiltUrl;
        }

        return $uri;
    }

}
