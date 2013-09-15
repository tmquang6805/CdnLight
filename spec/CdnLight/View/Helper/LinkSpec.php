<?php

namespace spec\CdnLight\View\Helper;

use PhpSpec\ObjectBehavior;

class LinkSpec extends ObjectBehavior
{
    function let($linkBuilderContainer) 
    {
        $linkBuilderContainer->beADoubleOf('CdnLight\Generator\LinkBuilderContainer');
        $this->beConstructedWith($linkBuilderContainer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CdnLight\View\Helper\Link');
    }
    
    function it_calls_the_link_builder_on_invoke_with_url($linkBuilderContainer)
    {
        $linkBuilderContainer->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");
        
        $this->__invoke("/example/file.js")->shouldReturn("http://example.com:80/example.js");
    }
    
    function it_returns_itself_on_invoke()
    {
        $this->__invoke()->shouldReturn($this);
    }
    
        function it_can_be_disabled($linkBuilderContainer)
    {
        $this->beConstructedWith($linkBuilderContainer, true);
        $linkBuilderContainer->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");

        $object = new \stdClass();
        $object->attributes = array('src' => "/example/file.js");

        $this->__invoke("/example/file.js");

        $linkBuilderContainer->getUri("/example/file.js")->shouldNotBeCalled();
    }
}
