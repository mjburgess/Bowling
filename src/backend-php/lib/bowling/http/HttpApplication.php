<?php
namespace bowling\http;
use bowling\Application;
use bowling\IRequest;

class HttpApplication extends Application {
    public function getAction(HttpRequest $req) {
        $action = $req->getTarget();
        return new $action($this->getServices());
    }

    public function run(IRequest $request) {
        $target = $this->getAction($request);
        return $target($request);
    }
}