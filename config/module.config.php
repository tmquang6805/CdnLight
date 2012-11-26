<?php

return array(
    'view_helpers' => array(
        'factories' => array(
            'headLinkCdn' => 'CdnLight\View\Helper\Service\HeadLinkCdnFactory',
            'headScriptCdn' => 'CdnLight\View\Helper\Service\HeadScriptCdnFactory',
            'linkCdn' => 'CdnLight\View\Helper\Service\LinkCdnFactory',
        ),
    ),
    'cdn_light' => array(
        'enabled' => true,
        'servers' => array(
            // define your servers config in your global/local config
        ),
    ),
);
