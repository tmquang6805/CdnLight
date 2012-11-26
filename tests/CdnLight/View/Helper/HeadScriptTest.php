<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\View\Helper\Placeholder;
use Zend\ServiceManager;
use Zend\View\HelperPluginManager;

class HeadScriptTest extends TestCase
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

    public function testCanNotRetrieveCdnLinkDisabled()
    {
        $helper = $this->sm->get('headScriptCdn');
        $helper->setEnabled(false);
        $helper->appendFile('/js/foo.js', 'text/javascript');
        $js1 = '<script type="text/javascript" src="/js/foo.js"></script>';
        $this->assertEquals($helper->toString(), $js1);
    }
}
