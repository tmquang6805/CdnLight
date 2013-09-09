<?php

namespace CdnLight\Generator;

class LinkBuilders
{
    private $linkBuilders;

    public function __construct($linkBuilders)
    {
        $this->linkBuilders = $linkBuilders;
    }
    
    public function getUri($input) {    
        $current = array_shift($this->linkBuilders);
        $uri = $current->getUri($input);
        array_push($this->linkBuilders, $current);
        
        return $uri;
    }
}
