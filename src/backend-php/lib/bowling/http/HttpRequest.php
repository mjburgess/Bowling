<?php
namespace bowling\http;
use bowling\IRequest;

class HttpRequest implements IRequest {
    const TARGET_KEY = 'action';

    private $post;
    private $server;
    // private $get, $headers etc.

    public static function fromHttpContext() {
        return new self($_POST, $_SERVER);
    }

    public function __construct($post=[], $server=[]) {
        $this->post = $post;
        $this->server = $server;
    }

    public function postGet($key) {
        return $this->post[$key];
    }

    public function postHas($key) {
        return isset($this->post[$key]);
    }

    public function requestMethod() {
        return $this->server['REQUEST_METHOD'];
    }

    public function getTarget() {
        return $this->post[self::TARGET_KEY];
    }
}
