<?php

namespace spec\CdnLight\View\Helper;

use PhpSpec\ObjectBehavior;

class HeadLinkSpec extends ObjectBehavior
{

    function let($linkBuilderContainer)
    {
        $linkBuilderContainer->beADoubleOf('CdnLight\Generator\LinkBuilderContainer');
        $this->beConstructedWith($linkBuilderContainer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CdnLight\View\Helper\HeadLink');
    }

    function it_can_append_cdn_ed_scripts($linkBuilderContainer)
    {
        $linkBuilderContainer->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");

        $object = new \stdClass();
        $object->attributes = array('src' => "/example/file.js");

        $this->prependStylesheet("/example/file.js");

        $linkBuilderContainer->getUri("/example/file.js")->shouldBeCalled();
    }
    
    function it_can_prepend_cdn_ed_scripts($linkBuilderContainer)
    {
        $linkBuilderContainer->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");

        $object = new \stdClass();
        $object->attributes = array('src' => "/example/file.js");

        $this->prependStylesheet("/example/file.js");

        $linkBuilderContainer->getUri("/example/file.js")->shouldBeCalled();
    }
    
    function it_can_be_disabled($linkBuilderContainer)
    {
        $this->beConstructedWith($linkBuilderContainer, true);
        $linkBuilderContainer->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");

        $object = new \stdClass();
        $object->attributes = array('src' => "/example/file.js");

        $this->prependStylesheet("/example/file.js");

        $linkBuilderContainer->getUri("/example/file.js")->shouldNotBeCalled();
    }

}
