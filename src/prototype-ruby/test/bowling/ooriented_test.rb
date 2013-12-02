require_relative '../../lib/bowling/ooriented'
require 'test/unit'

class OOrientedTest < Test::Unit::TestCase
  def test_complete
    basic_history     = [0, 0, 1, 1, 2, 2, 3, 3, 4,  4, 5, 4, 6, 3, 7, 2,  8, 1, 9, 0]
    exemplar_history  = [1, 4, 4, 5, 6, 4, 5, 5, 10, 0, 1, 7, 3, 6, 4, 10, 2, 8, 6]
    imperfect_history = [10, 10, 10, 9, 0, 2, 8, 10, 10, 10, 10, 10, 10, 10]
    perfect_history   = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10]

    assert_equal(65, Game.new.rollAll(basic_history).score)
    assert_equal(133, Game.new.rollAll(exemplar_history).score)
    assert_equal(257, Game.new.rollAll(imperfect_history).score)
    assert_equal(300, Game.new.rollAll(perfect_history).score)
  end
end