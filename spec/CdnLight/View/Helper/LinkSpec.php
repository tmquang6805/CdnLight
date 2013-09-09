<?php

namespace spec\CdnLight\View\Helper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LinkSpec extends ObjectBehavior
{
    function let($linkBuilders) 
    {
        $linkBuilders->beADoubleOf('CdnLight\Generator\LinkBuilders');
        $this->beConstructedWith($linkBuilders);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CdnLight\View\Helper\Link');
    }
    
    function it_calls_the_link_builder_on_invoke_with_url($linkBuilders)
    {
        $linkBuilders->getUri("/example/file.js")->willReturn("http://example.com:80/example.js");
        
        $this->__invoke("/example/file.js")->shouldReturn("http://example.com:80/example.js");
    }
    
    function it_returns_itself_on_invoke()
    {
        $this->__invoke()->shouldReturn($this);
    }
}
