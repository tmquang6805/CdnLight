<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use CdnLight\Generator\LinkBuilder;

class LinkBuilderTest extends TestCase
{
    public function testCanConfigureWithFullConfig()
    {
        $builder = new LinkBuilder(array('host' => 'server1.com', 'scheme' => 'http', 'port' => '80'));
        $uri = $builder->getUri('/css/layout.css');
        $this->assertEquals($uri, 'http://server1.com:80/css/layout.css');
    }
    
    public function testCanConfigureWithoutScheme()
    {
        $builder = new LinkBuilder(array('host' => 'server1.com', 'port' => ''));
        $uri = $builder->getUri('/css/layout.css');
        $this->assertEquals($uri, '//server1.com/css/layout.css');
    }
    
    public function testCanRetrieveUrlWithHost()
    {
        $builder = new LinkBuilder(array('host' => 'server1.com', 'scheme' => 'http', 'port' => '80'));
        
        $uri = $builder->getUri('http://www.mysite.com/css/layout.css');
        $this->assertEquals($uri, 'http://www.mysite.com/css/layout.css');
        
        $uri = $builder->getUri('//www.mysite.com/css/layout.css');
        $this->assertEquals($uri, '//www.mysite.com/css/layout.css');
    }
    
    public function testCanRetrieveUrlWithMTime()
    {
        $file = __DIR__ . '/../../_files/mktime';
        
        $builder = new LinkBuilder(array('host' => 'server1.com', 'assetMTimePath' => $file));
        $uri = $builder->getUri('/css/layout.css');
        $this->assertEquals($uri, '//server1.com/css/layout.css?m=' . filemtime($file));
    }
}
