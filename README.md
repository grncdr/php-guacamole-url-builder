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

In most cases, you will want to include a username and password in your connection
information:

```php
$url = $urlBuilder->url("myserver", "vnc", "myvncserver.internal", array(
    "guac.username" => "stephen",
    "guac.password" => "password"
));
```

**Warning:** The username and password will be included in the URL in plain-text.
You should either use SSL in front of your Guacamole server or firewall it off
from the outside world.

## Install

    composer require grncdr/guacamole-url-builder 0.8.x

## License

MIT

[guacamole-auth-hmac]: https://github.com/grncdr/guacamole-auth-hmac
