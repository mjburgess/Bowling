<?php
namespace bowling;

abstract class Action {
    private $services;

    public function __construct(array $services=[]) {
        $this->services = $services;
    }

    public function getService($service) {
        return $this->services[$service];
    }

    abstract public function __invoke($request);
}