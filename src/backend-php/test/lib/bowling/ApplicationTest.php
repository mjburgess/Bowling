<?php
namespace bowling;

use PHPUnit_Framework_TestCase;
use bowling\Application;
use bowling\IRequest;

class ApplicationStub extends Application {
    public function run(IRequest $r) {}
}

class ApplicationTest extends PHPUnit_Framework_TestCase {
    public function testServices() {
        $class = get_class(new ApplicationStub());

        $app = new ApplicationStub();
        $app->registerService(new ApplicationStub());
        $app->registerService(new ApplicationStub());

        $this->assertEquals([$class, $class], $app->getServices());
    }
}

