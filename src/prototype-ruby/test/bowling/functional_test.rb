require_relative '../../lib/bowling/functional'
require 'test/unit'

class TestFunctionalSolution < Test::Unit::TestCase
  def test_complete
    basic_history     = [0, 0, 1, 1, 2, 2, 3, 3, 4,  4, 5, 4, 6, 3, 7, 2,  8, 1, 9, 0]
    exemplar_history  = [1, 4, 4, 5, 6, 4, 5, 5, 10, 0, 1, 7, 3, 6, 4, 10, 2, 8, 6]
    imperfect_history = [10, 10, 10, 9, 0, 2, 8, 10, 10, 10, 10, 10, 10, 10]
    perfect_history   = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10]

    assert_equal(65, score(group_complete_frames(basic_history)))
    assert_equal(133, score(group_complete_frames(exemplar_history)))
    assert_equal(257, score(group_complete_frames(imperfect_history)))
    assert_equal(300, score(group_complete_frames(perfect_history)))
  end
end