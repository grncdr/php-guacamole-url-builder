<?php

namespace Guacamole;

class UrlBuilderTest extends \PHPUnit_Framework_TestCase
{
    protected $now = 1389035106;

    public function setUp()
    {
        $this->builder = new UrlBuilder(
            "my-secret",
            "http://guacamole.hatsize.int:8080/client.xhtml"
        );
    }

    public function testRdpUrlDefaults()
    {
        $this->assertEquals(
            'http://guacamole.hatsize.int:8080/client.xhtml?id=c%2Fmy-server&timestamp=1389035106000&guac.hostname=10.230.200.28&guac.protocol=rdp&guac.port=3389&signature=m998hxUEe6Z9C17bjphdQT92nJI%3D',
            $this->builder->url('my-server', 'rdp', '10.230.200.28', array('timestamp' => $this->now))
        );
    }

    public function testVncUrlDefaults()
    {
        $this->assertEquals(
            'http://guacamole.hatsize.int:8080/client.xhtml?id=c%2Fmy-server&timestamp=1389035106000&guac.hostname=10.230.200.28&guac.protocol=vnc&guac.port=5900&signature=L%2FOVI4aX%2BY5tZK0hQ7B8IYZNR6o%3D',
            $this->builder->url('my-server', 'vnc', '10.230.200.28', array('timestamp' => $this->now))
        );
    }

    public function testSshUrlDefaults()
    {
        $this->assertEquals(
            'http://guacamole.hatsize.int:8080/client.xhtml?id=c%2Fmy-server&timestamp=1389035106000&guac.hostname=10.230.200.28&guac.protocol=ssh&guac.port=22&signature=czQLlxX5bDj8hjHc%2F%2BJ%2FekLGBWI%3D',
            $this->builder->url('my-server', 'ssh', '10.230.200.28', array('timestamp' => $this->now))
        );
    }

    public function testExtraParams()
    {
        $this->assertEquals(
            'http://guacamole.hatsize.int:8080/client.xhtml?id=c%2Fmy-server&timestamp=1389035106000&guac.hostname=10.230.200.28&guac.protocol=ssh&guac.port=22&guac.username=stephen&guac.password=50%201337&signature=qvqCGEEQ0OMGNeP9YLJp9dGYmCk%3D',
            $this->builder->url('my-server', 'ssh', '10.230.200.28', array(
                'guac.username' => 'stephen',
                'guac.password' => '50 1337',
                'timestamp' => $this->now
            ))
        );
    }
}


