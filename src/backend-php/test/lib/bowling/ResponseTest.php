<?php
namespace bowling;
use bowling\Response;

use PHPUnit_Framework_TestCase;

class ResponseTest extends PHPUnit_Framework_TestCase {
    protected function testSetBody() {
        $response = new Response();
        $response->setBody('TESTING');

        $this->assertEquals('TESTING', (string) $response);
    }
}