<?php
namespace bowling\http;
use bowling\Response;
use PHPUnit_Framework_TestCase;
use bowling\http\HttpJsonResponse;

class HttpJsonResponseTest extends PHPUnit_Framework_TestCase{
    public function testSetBody($body) {
        if($body instanceof BowlingException) {
            $body = ['error' => $body->getMessage()];
        }

        parent::setBody(json_encode($body));
    }
}