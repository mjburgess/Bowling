<?php
namespace bowling\scoring;

class Frame {
    const PINS_PER_FRAME = 10;
    const STRIKE_BONUS   = 2;
    const SPARE_BONUS    = 1;

    private $firstRoll;
    private $secondRoll;
    private $bonusRolls;

    public function __construct() {
        $this->bonusRolls = [];
    }

    public function __toString() {
        return sprintf('%d, %d (%s)', $this->firstRoll, $this->secondRoll, implode(', ', $this->bonusRolls));
    }

    public function getRolls() {
        return [$this->firstRoll, $this->secondRoll];
    }

    public function getBonusRolls() {
        return $this->bonusRolls;
    }

    public function score() {
        if(!$this->isScored()) {
            return false;
        }

        return $this->firstRoll + $this->secondRoll + array_sum($this->bonusRolls);
    }

    public function isSpare() {
        return !$this->isStrike() && ($this->firstRoll + $this->secondRoll) == self::PINS_PER_FRAME;
    }

    public function isStrike() {
        return $this->firstRoll == self::PINS_PER_FRAME;
    }

    public function isOpen() {
        return isset($this->firstRoll) && isset($this->secondRoll) &&
        ($this->firstRoll + $this->secondRoll < self::PINS_PER_FRAME);
    }

    public function isScored() {
        return ($this->isStrike() && count($this->bonusRolls) == self::STRIKE_BONUS) ||
        ($this->isSpare()  && count($this->bonusRolls) == self::SPARE_BONUS)  ||
        $this->isOpen();
    }

    public function isFinished() {
        return  $this->isStrike() || $this->isSpare() || $this->isOpen();
    }

    public function roll($roll) {
        if(!isset($this->firstRoll)) {
            $this->firstRoll = $roll;
        } elseif(!isset($this->secondRoll) && !$this->isStrike()) {
            $this->secondRoll = $roll;
        } else {
            $this->bonusRolls[] = $roll;
        }

        return $this;
    }
}
