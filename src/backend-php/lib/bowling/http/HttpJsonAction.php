<?php
namespace bowling\http;
use bowling\Action;

abstract class HttpJsonAction extends Action {
    public function __invoke($httpReq) {
        $method   = $httpReq->requestMethod();
        $response = $this->$method($httpReq);

        if(!$response instanceof HttpJsonResponse) {
            $response = new HttpJsonResponse($response);
        }

        return $response;
    }

    abstract public function get(HttpRequest $r);
    abstract public function post(HttpRequest $r);
}


