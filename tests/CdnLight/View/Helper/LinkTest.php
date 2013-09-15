<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager;
use Zend\View\HelperPluginManager;

class LinkTest extends TestCase
{
    protected $sm;

    public function setUp()
    {
        $config = include __DIR__ . '/../../../../config/module.config.php';
        $config = array_merge($config, include __DIR__ . '/../../../../config/cdnlight.local.php');
        $config['cdn_light']['link_cdn'] = true;
        $config['cdn_light']['head_link'] = true;
        $config['cdn_light']['head_script'] = true;
        $this->sm = new HelperPluginManager(new ServiceManager\Config($config['view_helpers']));
        $smApp =  new ServiceManager\ServiceManager(new ServiceManager\Config($config['service_manager']));
        $smApp->setService('Config', $config);
        $this->sm->setServiceLocator($smApp);
    }

    public function testCanGetFactory()
    {
        $helper = $this->sm->get('linkCdn');
        $this->assertEquals(get_class($helper), 'CdnLight\View\Helper\Link');
    }

    public function testCanRetrieveCdnLink()
    {
        $helper = $this->sm->get('linkCdn');

        $image = 'http://server1.example.com:80/img/logo.png';
        $this->assertEquals($helper->cdn('/img/logo.png'), $image);

        $image = '//server2.example.com:81/img/logo.png';
        $this->assertEquals($helper('/img/logo.png'), $image);
    }

    public function testCanRetrieveCdnHardLink()
    {
        $helper = $this->sm->get('linkCdn');

        $image = 'http://www.myserver.com/img/logo.png';
        $this->assertEquals($helper->cdn('http://www.myserver.com/img/logo.png'), $image);

        $image = 'http://www.myserver.com/img/logo.png';
        $this->assertEquals($helper('http://www.myserver.com/img/logo.png'), $image);
    }
}
