ZF2 CdnLight module
========

Version 1.0.0 Created by [Vincent Blanchon](http://developpeur-zend-framework.fr/)

Introduction
------------

ZF2 CdnLight module provide view helpers to manage custom CDN for ZF2 application.
Just configure your module in cdnlight.local.php which will be moved in "/config/autoload" :

```php
return array(
    'cdn_light' => array(
        'HeadLink' => true,
        'HeadScript' => true,
        'LinkCdn' => false, // Bypass the CDN for this helper
        
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
                'scheme' => '', // Generate scheme less URIs
                'host' => 'server2.example.com',
                'port' => 81,
            ),
            'static_3' => array(
                'passthru' => true, // Do nothing to the urls
            ),
        ),
    ),
);
```

Yours CSS and JS files will use your CDN by turnover.

Usage
------------

Change nothing !

```php
$this->headLink()->appendStylesheet('/css/bootstrap.min.css')
                 ->appendStylesheet('/css/style.css')
                 ->appendStylesheet('/css/bootstrap-responsive.min.css');
```

Result will be :

```php
<link href="http://server1.com:80/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
<link href="http://server2.com:80/css/style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="http://server3.com:80/css/bootstrap-responsive.min.css" media="screen" rel="stylesheet" type="text/css" />
```

You can use a link view helper for a standalone usage :

```php
<img src="<?php $this->linkCdn('/img/logo.png'); ?>" alt="" />
```
