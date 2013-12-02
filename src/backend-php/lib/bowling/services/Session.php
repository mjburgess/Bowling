<?php
namespace bowling\services;

class Session {
    const DEFAULT_NAMESPACE = __NAMESPACE__;

    private $storage;

    public function __construct(&$storage=[]) {
        $this->storage = &$storage;
    }

    public static function fromHttpContext($namespace=self::DEFAULT_NAMESPACE) {
        session_start();
        return new self($_SESSION[$namespace]);
    }

    public function isEmpty($key) {
        return empty($this->storage[$key]);
    }

    public function write($key, $value) {
        $this->storage[$key] = $value;
    }

    public function read($key) {
        return $this->storage[$key];
    }

    public function update($key, $value) {
        $this->storage[$key][] = $value;
    }

    public function delete($key) {
        unset($this->storage[$key]);
    }
}
