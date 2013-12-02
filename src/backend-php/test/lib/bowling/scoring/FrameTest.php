<?php
namespace bowling\scoring;

use PHPUnit_Framework_TestCase;
use bowling\scoring\Frame;

class FrameTest extends PHPUnit_Framework_TestCase {
    private $spareFrame;
    private $unscoredFrame;
    private $strikeFrame;
    private $openFrame;

    public function setUp() {
        $this->spareFrame = new Frame();
        $this->spareFrame->roll(2)->roll(8)->roll(1);

        $this->unscoredFrame = new Frame();
        $this->unscoredFrame->roll(1);

        $this->strikeFrame = new Frame();
        $this->strikeFrame->roll(10)->roll(2)->roll(8);

        $this->openFrame = new Frame();
        $this->openFrame->roll(5)->roll(4);
    }
    public function testToString() {
        $this->assertEquals('2, 8 (1, )', (string) $this->spareFrame);
    }

    public function testGetRolls() {
        $this->assertEquals([2, 8], $this->spareFrame->getRolls());
    }

    public function testGetBonusRolls() {
        $this->assertEquals([1], $this->spareFrame->getBonusRolls());
    }

    public function testScore() {
        $this->assertEquals(11, $this->spareFrame->score());
        $this->assertEquals(false, $this->unscoredFrame->score());
    }

    public function testIsSpare() {
        $this->assertEquals(false, $this->unscoredFrame->isSpare());
        $this->assertEquals(false, $this->strikeFrame->isSpare());
        $this->assertEquals(false, $this->openFrame->isSpare());
        $this->assertEquals(true, $this->spareFrame->isSpare());
    }

    public function testIsStrike() {
        $this->assertEquals(false, $this->unscoredFrame->isStrike());
        $this->assertEquals(false, $this->openFrame->isStrike());
        $this->assertEquals(false, $this->spareFrame->isStrike());
        $this->assertEquals(true, $this->strikeFrame->isStrike());
    }

    public function testIsOpen() {
        $this->assertEquals(false, $this->unscoredFrame->isOpen());
        $this->assertEquals(false, $this->spareFrame->isOpen());
        $this->assertEquals(false, $this->strikeFrame->isOpen());
        $this->assertEquals(true, $this->openFrame->isOpen());
    }

    public function testIsScored() {
        $this->assertEquals(false, $this->unscoredFrame->isScored());
        $this->assertEquals(true, $this->spareFrame->isScored());
        $this->assertEquals(true, $this->strikeFrame->isScored());
        $this->assertEquals(true, $this->openFrame->isScored());
    }

    public function testRoll($roll) {
        $this->assertEquals(false, $this->unscoredFrame->score());
        $this->assertEquals(11, $this->spareFrame->score());
        $this->assertEquals(20, $this->strikeFrame->score());
        $this->assertEquals(9, $this->openFrame->score());
    }
}