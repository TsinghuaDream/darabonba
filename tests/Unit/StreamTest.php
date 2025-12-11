<?php

namespace AlibabaCloud\Dara\Tests;

use AlibabaCloud\Dara\Util\StreamUtil;
use AlibabaCloud\Dara\Request;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class StreamTest extends TestCase
{

    public function getStream()
    {
        return new Stream(fopen('https://jsonplaceholder.typicode.com/posts/1', 'r'));
    }

    public function testReadAsBytes()
    {
        $bytes = StreamUtil::readAsBytes($this->getStream());
        $this->assertEquals(123, $bytes[0]);
    }

    public function testReadAsString()
    {
        $string = StreamUtil::readAsString($this->getStream());
        $this->assertEquals($string[0], '{');
    }

    public function testReadAsJSON()
    {
        $result = StreamUtil::readAsJSON($this->getStream());
        $this->assertEquals(1, $result['userId']);
        $this->assertEquals(1, $result['id']);
    }
}