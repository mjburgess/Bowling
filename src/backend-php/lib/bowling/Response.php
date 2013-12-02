<?php
namespace bowling;

class Response {
    private $body;

    public function __construct($body='') {
        $this->setBody($body);
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function __toString() {
        return (string) $this->body;
    }
}