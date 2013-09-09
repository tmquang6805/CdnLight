<?php

namespace spec\CdnLight\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LinkBuilderSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->beConstructedWith(
                array(
                    'scheme' => 'http',
                    'host' => 'server2.example.com',
                    'port' => 80,
                )
        );

        $this->shouldHaveType('CdnLight\Generator\LinkBuilder');
    }

    function it_sets_cdn_host()
    {
        $this->beConstructedWith(
                array(
                    'scheme' => 'http',
                    'host' => 'server2.example.com',
                    'port' => 80,
                )
        );

        $this->getUri("/testing.js")->shouldReturn("http://server2.example.com:80/testing.js");
    }

    function it_does_not_set_cdn_host_when_host_present()
    {
        $this->beConstructedWith(
                array(
                    'scheme' => 'http',
                    'host' => 'server2.example.com',
                    'port' => 80,
                )
        );

        $this->getUri("http://www.example.com/testing.js")->shouldReturn("http://www.example.com/testing.js");
    }

    function it_generates_schemaless_uris()
    {
        $this->beConstructedWith(
                array(
                    'scheme' => '',
                    'host' => 'server2.example.com',
                    'port' => 80,
                )
        );

        $this->getUri("/testing.js")->shouldReturn("//server2.example.com:80/testing.js");
    }

    function it_puts_the_mtime_at_the_end_of_the_uri()
    {
        $filePath = "/tmp/" . getmypid() . "-" . time();
        touch($filePath);

        $this->beConstructedWith(
                array(
                    'assetMTimePath' => $filePath
                )
        );

        $this->getUri("/testing.js")->shouldReturn("/testing.js?m=" . filemtime($filePath));
        unlink($filePath);
    }

    function it_changes_nothing_if_passthru_is_set()
    {
        $this->beConstructedWith(
                array(
                    'passthru' => true,
                )
        );

        $this->getUri("/testing.js")->shouldReturn("/testing.js");
    }

}
