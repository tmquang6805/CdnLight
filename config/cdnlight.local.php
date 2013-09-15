<?php

return array(
    'cdn_light' => array(
        'head_link' => true,
        'head_script' => true,
        'link_cdn' => false, // Bypass the CDN for this helper
        
        'global' => array(// Set some values across all servers
            'assetMTimePath' => '/tmp/path/to/file' // Append this mtime in your query string
        ),
        'servers' => array(
            'static_1' => array(
                'scheme' => 'http',
                'host' => 'server1.example.com',
                'port' => 80
            ),
            'static_2' => array(
                'scheme' => '',
                'host' => 'server2.example.com',
                'port' => 81,
            ),
            'static_3' => array(
                'passthru' => true, // Do nothing to the urls
            ),
        ),
    ),
);
