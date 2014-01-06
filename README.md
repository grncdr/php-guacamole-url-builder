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

Add `"grncdr/guacamole-url-builder": "0.8.x"` to the `"require"` section of
your `composer.json`.

## License

MIT

[guacamole-auth-hmac]: https://github.com/grncdr/guacamole-auth-hmac
