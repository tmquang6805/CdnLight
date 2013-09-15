<?php

namespace spec\CdnLight\Generator;

use PhpSpec\ObjectBehavior;

class LinkBuilderContainerSpec extends ObjectBehavior
{
    function let($linkBuilder1, $linkBuilder2, $linkBuilder3)
    {
        $linkBuilder1->beADoubleOf('CdnLight\Generator\LinkBuilder');
        $linkBuilder2->beADoubleOf('CdnLight\Generator\LinkBuilder');
        $linkBuilder3->beADoubleOf('CdnLight\Generator\LinkBuilder');
        
        $this->beConstructedWith(array($linkBuilder1, $linkBuilder2, $linkBuilder3));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CdnLight\Generator\LinkBuilderContainer');
    }
    
    function it_calls_a_different_generator_each_time_it_is_invoked($linkBuilder1, $linkBuilder2, $linkBuilder3) 
    {
        $linkBuilder1->getUri("1")->willReturn("1");
        $linkBuilder2->getUri("2")->willReturn("2");
        $linkBuilder3->getUri("3")->willReturn("3");
        
        $this->getUri("1")->shouldReturn("1");
        $this->getUri("2")->shouldReturn("2");
        $this->getUri("3")->shouldReturn("3");
        $this->getUri("1")->shouldReturn("1");
        $this->getUri("2")->shouldReturn("2");
        $this->getUri("3")->shouldReturn("3");
    }
}
