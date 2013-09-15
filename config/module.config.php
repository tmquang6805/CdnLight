<?php

return array(
    'view_helpers' => array(
        'factories' => array(
            'headLinkCdn' => 'CdnLight\View\Helper\Service\HeadLinkCdnFactory',
            'headScriptCdn' => 'CdnLight\View\Helper\Service\HeadScriptCdnFactory',
            'linkCdn' => 'CdnLight\View\Helper\Service\LinkCdnFactory',
        ),
        'aliases' => array(
            'headLink' => 'headLinkCdn',
            'headScript' => 'headScriptCdn',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'cdnLinkBuilderContainer' => 'CdnLight\Generator\Service\LinkBuilderContainerFactory',
        )
    )
);
