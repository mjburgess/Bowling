class Frame
  PINS_PER_FRAME = 10
  STRIKE_BONUS   = 2
  SPARE_BONUS    = 1

  def initialize()
    @first_roll   = nil
    @second_roll  = nil
    @bonus_rolls  = []
  end

  def to_s
    "#{@first_roll}.#{@second_roll}[#{@bonus_rolls[0]}.#{@bonus_rolls[1]}]"
  end

  def roll(roll)
    if @first_roll.nil?
      @first_roll = roll
    elsif @second_roll.nil? and not strike?
      @second_roll = roll
    else
      @bonus_rolls.push(roll)
    end
  end

  def score
    base_score + @bonus_rolls[0].to_i + @bonus_rolls[1].to_i
  end

  def base_score
    @first_roll.to_i + @second_roll.to_i
  end

  def strike?
    not @first_roll.nil? and @first_roll == Frame::PINS_PER_FRAME
  end

  def spare?
    base_score == Frame::PINS_PER_FRAME and not strike?
  end

  def open?
    base_score < Frame::PINS_PER_FRAME and not @second_roll.nil?
  end

  def complete?
    (strike? and @bonus_rolls.length == Frame::STRIKE_BONUS) or
    (spare?  and @bonus_rolls.length == Frame::SPARE_BONUS)  or
     open?
  end

  def rolled?
    strike? or spare? or not (@first_roll.nil? or @second_roll.nil?)
  end
end

class Game
  FRAMES_PER_GAME = 10

  def initialize()
    @frames = [Frame.new]
  end

  def to_s
    @frames.map(&:to_s).to_s
  end

  def roll(roll)
    if @frames.last.rolled?
      @frames.push(Frame.new) unless @frames.length == Game::FRAMES_PER_GAME
    end

    complete(roll)
  end

  def rollAll(rolls)
    rolls.each { |r|
      roll(r)
    }

    self
  end

  def complete(roll)
    @frames.each { |frame|
      if not frame.complete?
        frame.roll(roll)
      end
    }
  end

  def scores
    @frames.map(&:score)
  end

  def score
    scores.inject(&:+)
  end

  def describe
    score.to_s + ': ' + @frames.map(&:to_s).to_s
  end
end