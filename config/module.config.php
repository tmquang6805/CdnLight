<?php

return array(
    'view_helpers' => array(
        'factories' => array(
            'headLinkCdn' => function($sm) {
                $config = $sm->getServiceLocator()->get('Config');

                $disabled = false;

                if (isset($config['cdn_light']['HeadLink']) && !$config['cdn_light']['HeadLink']) {
                    $disabled = true;
                }

                return new CdnLight\View\Helper\HeadLink($sm->getServiceLocator()->get('cdnLinkBuilders'),
                    $disabled);
            },
            'headScriptCdn' => function($sm) {
                $config = $sm->getServiceLocator()->get('Config');

                $disabled = false;

                if (isset($config['cdn_light']['HeadScript']) && !$config['cdn_light']['HeadScript']) {
                    $disabled = true;
                }

                return new CdnLight\View\Helper\HeadScript($sm->getServiceLocator()->get('cdnLinkBuilders'),
                    $disabled);
            },
            'linkCdn' => function($sm) {
                $config = $sm->getServiceLocator()->get('Config');

                $disabled = false;

                if (isset($config['cdn_light']['LinkCdn']) && !$config['cdn_light']['LinkCdn']) {
                    $disabled = true;
                }

                return new CdnLight\View\Helper\Link($sm->getServiceLocator()->get('cdnLinkBuilders'),
                    $disabled);
            },
        ),
        'aliases' => array(
            'headLink' => 'headLinkCdn',
            'headScript' => 'headScriptCdn',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'cdnLinkBuilders' => function($sm) {
                $config = $sm->get('Config');

                $builders = array();

                foreach ($config['cdn_light']['servers'] as $server) {
                    $builders[] = new CdnLight\Generator\LinkBuilder(array_merge($config['cdn_light']['global'],
                            $server));
                }

                return new CdnLight\Generator\LinkBuilders($builders);
            },
        )
    )
);
