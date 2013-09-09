<?php

namespace spec\CdnLight\View\Helper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HeadScriptSpec extends ObjectBehavior
{

    function let($linkBuilders)
    {
        $linkBuilders->beADoubleOf('CdnLight\Generator\LinkBuilders');
        $this->beConstructedWith($linkBuilders);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CdnLight\View\Helper\HeadScript');
    }

    function it_can_append_cdn_ed_scripts($linkBuilders)
    {
        $linkBuilders->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");

        $object = new \stdClass();
        $object->attributes = array('src' => "/example/file.js");

        $this->appendFile("/example/file.js");

        $linkBuilders->getUri("/example/file.js")->shouldBeCalled();
    }
    
    function it_can_prepend_cdn_ed_scripts($linkBuilders)
    {
        $linkBuilders->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");

        $object = new \stdClass();
        $object->attributes = array('src' => "/example/file.js");

        $this->prependFile("/example/file.js");

        $linkBuilders->getUri("/example/file.js")->shouldBeCalled();
    }
    
    function it_can_be_disabled($linkBuilders)
    {
        $this->beConstructedWith($linkBuilders, true);
        $linkBuilders->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");

        $object = new \stdClass();
        $object->attributes = array('src' => "/example/file.js");

        $this->prependFile("/example/file.js");

        $linkBuilders->getUri("/example/file.js")->shouldNotBeCalled();
    }

}
