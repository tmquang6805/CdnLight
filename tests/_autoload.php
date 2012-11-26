<?php

require_once __DIR__ . '/../../zf2/library/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'CdnLight' => __DIR__ . '/../src/CdnLight',
            'CdnLightTest' => __DIR__ . '/CdnLight',
        ),
    ),
));