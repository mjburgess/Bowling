<?php

namespace bowling\scoring;

use PHPUnit_Framework_TestCase;
use bowling\scoring\Game;

class GameTest extends PHPUnit_Framework_TestCase {

    public function testGameFrame() {
        $basic     = [0, 0, 1, 1, 2, 2, 3, 3, 4,  4, 5, 4, 6, 3, 7, 2,  8, 1, 9, 0];
        $exemplar  = [1, 4, 4, 5, 6, 4, 5, 5, 10, 0, 1, 7, 3, 6, 4, 10, 2, 8, 6];
        $imperfect = [10, 10, 10, 9, 0, 2, 8, 10, 10, 10, 10, 10, 10, 10];
        $perfect   = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];

        $this->assertEquals(65, (new Game())->rollAll($basic)->score());
        $this->assertEquals(133, (new Game())->rollAll($exemplar)->score());
        $this->assertEquals(257, (new Game())->rollAll($imperfect)->score());
        $this->assertEquals(300, (new Game())->rollAll($perfect)->score());
    }

    public function testToString() {
//        return $this->score() . ': ' . implode("\t", $this->frames);
    }

    public function testIsFrameFinished() {
//        return end($this->frames)->isFinished();
    }

    public function testIsGameFinshed() {
//        return count($this->frames) == self::FRAMES_PER_GAME;
    }

    public function testScores() {
//        return array_map(function ($frame) { return $frame->score(); }, $this->frames);
    }

    public function testScore() {
//        return array_sum($this->scores());
    }

    public function testRoll($roll) {
//        if($this->isFrameFinished() && !$this->isGameFinshed()) {
//            $this->frames[] = new Frame();
//        }
//
//        $this->updateFrames($roll);
    }

    public function testRollAll(array $rolls) {
//        foreach($rolls as $roll) {
//            $this->roll($roll);
//        }
//
//        return $this;
    }

    public function testUpdateFrames($roll) {
//        foreach($this->frames as $frame) {
//            if(!$frame->isScored()) {
//                $frame->roll($roll);
//            }
//        }
    }

    public function testDescribe() {
//        $out = ['score'  => $this->score(),
//                'frames' => []];
//
//        foreach($this->frames as $frame) {
//            $out['frames'][] = [
//                'score' => $frame->score(),
//                'rolls' => $frame->getRolls(),
//                'bonuses' => $frame->getBonusRolls()
//            ];
//        }
//
//        return $out;
    }
}