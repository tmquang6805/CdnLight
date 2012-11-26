<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\View\Helper\Placeholder;
use Zend\ServiceManager;
use Zend\View\HelperPluginManager;

class LinkTest extends TestCase
{
    protected $sm;

    public function setUp()
    {
        $config = include __DIR__ . '/../../../module.config.test.php';
        $this->sm = new HelperPluginManager(new ServiceManager\Config($config['view_helpers']));
        $smApp =  new ServiceManager\ServiceManager();
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

    public function testCanNotRetrieveCdnLinkDisabled()
    {
        $helper = $this->sm->get('linkCdn');
        $helper->setEnabled(false);
        $image = '/img/logo.png';
        $this->assertEquals($helper->cdn('/img/logo.png'), $image);
    }
}
