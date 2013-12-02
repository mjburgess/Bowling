<?php
namespace bowling\http;

use PHPUnit_Framework_TestCase;
use bowling\http\HttpJsonAction;

class HttpJsonActionStub extends HttpJsonAction {
    public function get(HttpRequest $r){}
    public function post(HttpRequest $r) {
        return [1, 2, 3];
    }
}

class HttpJsonActionTest extends PHPUnit_Framework_TestCase {
    public function testInvoke() {
        $htja = new HttpJsonActionStub();
        $hr = new HttpRequest([], ['REQUEST_METHOD'=>'POST']);

        $response = $htja($hr);
        $this->assertEquals(json_encode([1,2,3], (string) $response($hr)));
    }
}


