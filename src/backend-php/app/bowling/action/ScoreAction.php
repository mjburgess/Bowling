<?php
namespace bowling\action;

use bowling\BowlingException;
use bowling\http\HttpJsonAction;
use bowling\http\HttpRequest;

use bowling\scoring\Game;

class ScoreAction extends HttpJsonAction {
    const KEY = 'roll';

    public function get(HttpRequest $httpReq) {
        throw new BowlingException(__CLASS__ . ' does not respond to GET!');
    }

    public function post(HttpRequest $httpReq) {
        if($httpReq->postHas('clear')) {
            $this->clearSession();
            return new BowlingException('Cleared!');
        } else {
            $rolls = $this->updateSession($httpReq->postGet(self::KEY));
            return (new Game())->rollAll($rolls)->describe();
        }
    }

    private function clearSession() {
        $this->getService('bowling\services\Session')->delete(self::KEY);
    }

    private function updateSession($roll) {
        $session = $this->getService('bowling\services\Session');

        if($session->isEmpty(self::KEY)) {
            $session->write(self::KEY, []);
        }

        $session->update(self::KEY, $roll);

        return $session->read(self::KEY);
    }
}