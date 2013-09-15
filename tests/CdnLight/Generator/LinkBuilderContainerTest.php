<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use CdnLight\Generator\LinkBuilder;
use CdnLight\Generator\LinkBuilderContainer;

class LinkBuilderContainerTest extends TestCase
{
    public function testCanRetrieveLinkBuilder()
    {
        $list = array();
        $list[]  = new LinkBuilder(array('host' => 'server1.com', 'scheme' => 'http', 'port' => ''));
        $list[]  = new LinkBuilder(array('host' => 'server2.com'));
        $list[]  = new LinkBuilder(array('host' => 'server3.com', 'passthru' => true));
        $container = new LinkBuilderContainer($list);
        
        $link = $container->getUri('/css/layout.css');
        $this->assertEquals($link, 'http://server1.com/css/layout.css');
        
        $link = $container->getUri('/css/layout.css');
        $this->assertEquals($link, '//server2.com/css/layout.css');
        
        $link = $container->getUri('/css/layout.css');
        $this->assertEquals($link, '/css/layout.css');
        
        $link = $container->getUri('/css/layout.css');
        $this->assertEquals($link, 'http://server1.com/css/layout.css');
    }
}
