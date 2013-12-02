<?php
namespace bowling\http;
use bowling\IRequest;
use PHPUnit_Framework_TestCase;

class HttpRequestTest extends PHPUnit_Framework_TestCase{
    public function testFromHttpContext() {
        return new self($_POST, $_SERVER);
    }

    public function testPostGet($key) {
        return $this->post[$key];
    }

    public function testPostHas($key) {
        return isset($this->post[$key]);
    }

    public function testRequestMethod() {
        return $this->server['REQUEST_METHOD'];
    }

    public function testGetTarget() {
        return $this->post[self::TARGET_KEY];
    }
}
