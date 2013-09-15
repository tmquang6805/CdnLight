<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager;
use Zend\View\HelperPluginManager;

class HeadScriptTest extends TestCase
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
        $helper = $this->sm->get('headScriptCdn');
        $this->assertEquals(get_class($helper), 'CdnLight\View\Helper\HeadScript');
    }

    public function testCanRetrieveCdnScript()
    {
        $helper = $this->sm->get('headScriptCdn');

        $helper->appendFile('/js/foo.js', 'text/javascript');
        $js1 = '<script type="text/javascript" src="http://server1.example.com:80/js/foo.js"></script>';
        $this->assertEquals($helper->toString(), $js1);

        $helper->appendFile('/js/bar.js', 'text/javascript');
        $js2 = '<script type="text/javascript" src="//server2.example.com:81/js/bar.js"></script>';
        $this->assertEquals(
            $helper->toString(),
            $js1 . $helper->getSeparator() . $js2
        );

        $helper->appendFile('/js/baz.js', 'text/javascript');
        $js3 = '<script type="text/javascript" src="/js/baz.js"></script>';
        $this->assertEquals(
            $helper->toString(),
            $js1 . $helper->getSeparator() . $js2 . $helper->getSeparator() . $js3
        );

        $helper->appendFile('/js/foo-baz.js', 'text/javascript');
        $js4 = '<script type="text/javascript" src="http://server1.example.com:80/js/foo-baz.js"></script>';
        $this->assertEquals(
            $helper->toString(),
            $js1 . $helper->getSeparator() . $js2 . $helper->getSeparator() . $js3 . $helper->getSeparator() . $js4
        );
    }

    public function testCanRetrieveCdnHardScript()
    {
        $helper = $this->sm->get('headScriptCdn');

        $helper->appendFile('http://www.mydomaine.fr/js/foo.js', 'text/javascript');
        $js1 = '<script type="text/javascript" src="http://www.mydomaine.fr/js/foo.js"></script>';
        $this->assertEquals($helper->toString(), $js1);
    }
}
