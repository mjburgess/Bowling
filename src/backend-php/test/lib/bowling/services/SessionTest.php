<?php
namespace bowling\services;

use bowling\services\Session;
use PHPUnit_Framework_TestCase;


class SessionTest extends PHPUnit_Framework_TestCase {
    private $session;
    private $store;

    public function testFromHttpContext() {
        session_start();
        $_SESSION['TESTING'] = ['TEST' => 101];

        $session = Session::fromHttpContext('TESTING');
        $this->assertEquals(101, $session->read('TEST'));
    }

    public function setUp() {
        $this->store   = ['TEST' => 101];
        $this->session = new Session($store);
    }
    public function testIsEmpty($key) {
        $this->assertEquals(true, $this->session->isEmpty('TESTING'));
        $this->assertEquals(false, $this->session->isEmpty('TEST'));
    }

    public function testWrite($key, $value) {
        $this->session->write('FOOBAR', 10);

        $this->assertEquals(10, $this->store['FOOBAR']);
    }

    public function testRead($key) {
        $this->assertEquals(101, $this->session->read('TEST'));
    }

    public function testUpdate($key, $value) {
        $this->session->write('UPDATE', [1]);
        $this->assertEquals([1], $this->session->read('UPDATE'));

        $this->session->update('UPDATE', 2);
        $this->assertEquals([1,2], $this->session->read('UPDATE'));
    }

    public function testDelete($key) {
        $this->session->write('TESTABLE', 200);
        $this->assertEquals(false, $this->session->isEmpty('TESTABLE'));

        $this->session->delete('TESTABLE');
        $this->assertEquals(true, $this->session->isEmpty('TESTABLE'));
    }
}
