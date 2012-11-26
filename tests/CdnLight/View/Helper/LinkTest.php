<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\View\Helper\Placeholder;
use Zend\ServiceManager;

class LinkTest extends TestCase
{
    protected $sm;

    public function setUp()
    {
        require_once __DIR__ . '/../../../../Module.php';
        $module = new \CdnLight\Module();
        $config = include __DIR__ . '/../../../../config/module.config.php';
        $this->sm = new ServiceManager\ServiceManager(new ServiceManager\Config($config['view_helpers']));
        $this->sm->setService('Config', $config);
    }

    public function testCanGetFactory()
    {
        $helper = $this->sm->get('linkCdn');
        $this->assertEquals(get_class($helper), 'CdnLight\View\Helper\Link');
    }

    public function testCanRetrieveCdnLink()
    {
        $helper = $this->sm->get('linkCdn');

        $image = 'http://server1.com:80/img/logo.png';
        $this->assertEquals($helper->cdn('/img/logo.png'), $image);

        $image = 'http://server1.com:80/img/logo.png';
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
