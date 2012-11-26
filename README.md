ZF2 CdnLight module
========

Version 0.1 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

ZF2 CdnLight module provide view helpers to manage custom CDN for ZF2 application.
Just configure your module :

```php
return array(
    'cdn_light' => array(
        'servers' => array(
            'static_1' => array(
                'scheme' => 'http',
                'host' => 'server1.com',
                'port' => 80,
            ),
            'static_2' => array(
                'scheme' => 'http',
                'host' => 'server2.com',
                'port' => 80,
            ),
            'static_3' => array(
                'scheme' => 'http',
                'host' => 'server3.com',
                'port' => 80,
            ),
        ),
    ),
);

```

Yours CSS and JS files will use your CDN by turnover.
Juste replace view helpers "headLink" by "headLinkCdn" :


```html
$this->headLinkCdn()->appendStylesheet('/css/bootstrap.min.css')
                 ->appendStylesheet('/css/style.css')
                 ->appendStylesheet('/css/bootstrap-responsive.min.css');

```