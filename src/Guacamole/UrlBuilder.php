<?php

namespace Guacamole;

class UrlBuilder {
    private static $signedParams = array(
        'guac.username',
        'guac.password',
        'guac.hostname',
        'guac.port'
    );

    /** @var string */
    protected $clientUrl;

    /** @var string */
    protected $secretKey;

    public function __construct($secretKey, $clientUrl)
    {
        $this->clientUrl = $clientUrl;
        $this->secretKey = $secretKey;
    }

    public function url($connectionId, $protocol, $hostname, $extraParams = array())
    {
        $timestamp = 1000 * (
            array_key_exists('timestamp', $extraParams)
                ? $extraParams['timestamp']
                : time());

        // Array of query parameters to pass to guacamole
        $qp = array(
            'id'            => 'c/' . $connectionId,
            'timestamp'     => $timestamp,
            'guac.hostname' => $hostname,
            'guac.protocol' => $protocol
        );

        if (!array_key_exists('guac.port', $qp)) {
            switch ($protocol) {
            case 'rdp':
                $qp['guac.port'] = '3389';
                break;
            case 'vnc':
                $qp['guac.port'] = '5900';
                break;
            case 'ssh':
                $qp['guac.port'] = '22';
            }
        }

        // Copy any extra guacamole key value params into the query string
        foreach ($extraParams as $key => $value) {
            if (strpos($key, 'guac.') === 0) {
                $qp[$key]  = $value;
            }
        }

        $message = "$timestamp$protocol";

        // It's important that the message string used to generate the signature
        // is built in the correct order
        foreach (self::$signedParams as $name) {
            $value = @$qp[$name];
            if (is_null($value)) {
                continue;
            }
            $message .= substr($name, 5);
            $message .= $value;
        }

        return $this->clientUrl . '?'
            . str_replace('+', '%20', http_build_query($qp))
            . '&'
            . http_build_query(array(
                'signature' => base64_encode(hash_hmac('sha1', $message, $this->secretKey, 1))
            ));
    }
}
