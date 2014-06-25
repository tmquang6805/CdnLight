<?php

return array(
    'view_helpers'    => [
        'factories' => [
            'headLinkCdn'   => 'CdnLight\View\Helper\Service\HeadLinkCdnFactory',
            'headScriptCdn' => 'CdnLight\View\Helper\Service\HeadScriptCdnFactory',
            'linkCdn'       => 'CdnLight\View\Helper\Service\LinkCdnFactory',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'cdnLinkBuilderContainer' => 'CdnLight\Generator\Service\LinkBuilderContainerFactory',
        ],
    ],
);
