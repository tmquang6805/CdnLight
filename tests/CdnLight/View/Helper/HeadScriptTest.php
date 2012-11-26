<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\View\Helper\Placeholder;
use Zend\ServiceManager;

class HeadScriptTest extends TestCase
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

    public function tearDown()
    {
        Placeholder\Registry::unsetRegistry();
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
        $js1 = '<script type="text/javascript" src="http://server1.com:80/js/foo.js"></script>';
        $this->assertEquals($helper->toString(), $js1);

        $helper->appendFile('/js/bar.js', 'text/javascript');
        $js2 = '<script type="text/javascript" src="http://server2.com:80/js/bar.js"></script>';
        $this->assertEquals(
            $helper->toString(),
            $js1 . $helper->getSeparator() . $js2
        );

        $helper->appendFile('/js/baz.js', 'text/javascript');
        $js3 = '<script type="text/javascript" src="http://server3.com:80/js/baz.js"></script>';
        $this->assertEquals(
            $helper->toString(),
            $js1 . $helper->getSeparator() . $js2 . $helper->getSeparator() . $js3
        );

        $helper->appendFile('/js/foo-baz.js', 'text/javascript');
        $js4 = '<script type="text/javascript" src="http://server1.com:80/js/foo-baz.js"></script>';
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
