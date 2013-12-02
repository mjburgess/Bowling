<?php
namespace bowling;

abstract class Application {
    private $services;

    public function __construct(array $services=[]) {
        $this->services = $services;
    }

    public function getServices() {
        return $this->services;
    }

    public function registerService($service) {
        $this->services[get_class($service)] = $service;
    }

    abstract function run(IRequest $request);
}

