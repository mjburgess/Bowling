<?php
namespace bowling\http;
use bowling\http\HttpApplication;

use PHPUnit_Framework_TestCase;


class TestAction {
    public function __invoke() {
        return 'TESTING';
    }
}

class HttpApplicationTest extends PHPUnit_Framework_TestCase {

    public function testGetAction() {
        $app = new HttpApplication();
        $hr  = new HttpRequest([HttpRequest::TARGET_KEY => 'TestAction'], ['REQUEST_METHOD'=>'POST']);

        $this->assertInstanceOf('TestAction', $app->getAction($hr));
    }

    public function testRun() {
        $app = new HttpApplication();
        $hr  = new HttpRequest([HttpRequest::TARGET_KEY => 'TestAction'], ['REQUEST_METHOD'=>'POST']);

        $this->assertEquals('TESTING', $app->run($hr));
    }
}