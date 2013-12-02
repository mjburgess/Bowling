<?php
namespace bowling\http;
use bowling\Response;

class HttpJsonResponse extends Response {
    public function setBody($body) {
        if($body instanceof BowlingException) {
            $body = ['error' => $body->getMessage()];
        }

        parent::setBody(json_encode($body));
    }
}