<?php

namespace bowling\scoring;

class Game {
    const FRAMES_PER_GAME = 10;

    private $frames;

    public function __construct() {
        $this->frames = [new Frame()];
    }

    public function __toString() {
        return $this->score() . ': ' . implode("\t", $this->frames);
    }

    public function isFrameFinished() {
        return end($this->frames)->isFinished();
    }

    public function isGameFinshed() {
        return count($this->frames) == self::FRAMES_PER_GAME;
    }

    public function scores() {
        return array_map(function ($frame) { return $frame->score(); }, $this->frames);
    }

    public function score() {
        return array_sum($this->scores());
    }

    public function roll($roll) {
        if($this->isFrameFinished() && !$this->isGameFinshed()) {
            $this->frames[] = new Frame();
        }

        $this->updateFrames($roll);
    }

    public function rollAll(array $rolls) {
        foreach($rolls as $roll) {
            $this->roll($roll);
        }

        return $this;
    }

    public function updateFrames($roll) {
        foreach($this->frames as $frame) {
            if(!$frame->isScored()) {
                $frame->roll($roll);
            }
        }
    }

    public function describe() {
        $out = ['score'  => $this->score(),
                'frames' => []];

        foreach($this->frames as $frame) {
            $out['frames'][] = [
                'score' => $frame->score(),
                'rolls' => $frame->getRolls(),
                'bonuses' => $frame->getBonusRolls()
            ];
        }

        return $out;
    }
}