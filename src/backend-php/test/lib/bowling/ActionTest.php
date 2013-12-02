<?php
namespace bowling;

use PHPUnit_Framework_TestCase;
use bowling\Action;

class ActionStub extends Action {
    public function __invoke($r) {}
}

class ActionTest extends PHPUnit_Framework_TestCase {
    public function testGetService($service) {
        $action = new ActionStub([1, 'a' => 2]);

        $this->assertEquals(1, $action->getService(0));
        $this->assertEquals(2, $action->getService('a'));
    }
}