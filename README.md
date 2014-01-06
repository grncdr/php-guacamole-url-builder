# guacamole-url-builder

[![Build Status](https://travis-ci.org/grncdr/php-guacamole-url-builder.png?branch=master)](https://travis-ci.org/grncdr/php-guacamole-url-builder)

Create signed URLs for use with [guacamole-auth-hmac][] in PHP.

## Synopsis

```php
$urlBuilder = new Guacamole\UrlBuilder(
    "my secret key",
    "http://myguacamoleserver.internal/client.xhtml"
);
$url = $urlBuilder->url("myserver", "vnc", "myvncserver.internal");
```

## Install

   composer require grncdr/guacamole-url-builder@0.8.x

## License

MIT

[guacamole-auth-hmac]: https://github.com/grncdr/guacamole-auth-hmac
