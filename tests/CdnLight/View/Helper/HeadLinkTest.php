<?php

namespace CdnLightTest\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\View\Helper\Placeholder;
use Zend\ServiceManager;

class HeadLinkTest extends TestCase
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
        $helper = $this->sm->get('headLinkCdn');
        $this->assertEquals(get_class($helper), 'CdnLight\View\Helper\HeadLink');
    }

    public function testCanRetrieveCdnLink()
    {
        $helper = $this->sm->get('headLinkCdn');

        $helper->appendStylesheet('/css/foo.css');
        $style1 = '<link href="http://server1.com:80/css/foo.css" media="screen" rel="stylesheet" type="text/css" />';
        $this->assertEquals($helper->toString(), $style1);

        $helper->appendStylesheet('/css/bar.css');
        $style2 = '<link href="http://server2.com:80/css/bar.css" media="screen" rel="stylesheet" type="text/css" />';
        $this->assertEquals(
            $helper->toString(),
            $style1 . $helper->getSeparator() . $style2
        );

        $helper->appendStylesheet('/css/baz.css');
        $style3 = '<link href="http://server3.com:80/css/baz.css" media="screen" rel="stylesheet" type="text/css" />';
        $this->assertEquals(
            $helper->toString(),
            $style1 . $helper->getSeparator() . $style2 . $helper->getSeparator() . $style3
        );

        $helper->appendStylesheet('/css/foo-baz.css');
        $style4 = '<link href="http://server1.com:80/css/foo-baz.css" media="screen" rel="stylesheet" type="text/css" />';
        $this->assertEquals(
            $helper->toString(),
            $style1 . $helper->getSeparator() . $style2 . $helper->getSeparator() . $style3 . $helper->getSeparator() . $style4
        );
    }

    public function testCanRetrieveCdnHardLink()
    {
        $helper = $this->sm->get('headLinkCdn');

        $helper->appendStylesheet('http://www.mydomaine.fr/css/foo.css');
        $style1 = '<link href="http://www.mydomaine.fr/css/foo.css" media="screen" rel="stylesheet" type="text/css" />';
        $this->assertEquals($helper->toString(), $style1);
    }
}
