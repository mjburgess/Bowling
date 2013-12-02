<?php
namespace bowling;
use PHPUnit_Framework_TestCase;

use bowling\BowlingException;

class BowlingExceptionTest extends PHPUnit_Framework_TestCase {
    public function testMessage() {
        $ex = new BowlingException('TESTING');

        $this->assertEquals('TESTING', $ex->getMessage());
    }
}