def pins_cleared(frame)
  if frame[0] == 10
    10
  else
    frame[0] + frame[1]
  end

end

def frame_status(frame)
  if pins_cleared(frame) < 10
    :open
  elsif frame[0] == 10
    :strike
  else
    :spare
  end
end

def frame_bonus(rolls)
  if rolls.length > 1
    rolls[0] + rolls[1]
  elsif rolls.length > 0
    rolls[0]
  else
    0
  end
end

def bonus_rolls(status, rolls)
  if status == :spare
    [rolls[0]]
  elsif status == :strike
    [rolls[0], rolls[1]]
  else
    []
  end
end

def frame_score(frame, *next_rolls)
  pins_cleared(frame) + frame_bonus(bonus_rolls(frame_status(frame), next_rolls.flatten))
end

def scores(game, no_frames=10)
  Array.new(no_frames) { |index|
    frame_score(*segment(game, index, 3))
  }
end

def score(game)
  scores(game).inject(&:+)
end

def describe_game(scores)
  "Total #{scores.inject(&:+)}; Scores #{scores}"
end

def group_on(array, eq)
  array.slice_before(eq).flat_map {
      |x| x.partition {|i| i == eq }
  }
end

def collate(array, size)
  array.flat_map {
      |x| x.each_slice(size).to_a
  }
end

def segment(array, start, size)
  array.slice(start..(start + size))
end

def group_complete_frames(rolls, pins_per_frame=10, rolls_per_frame=2)
  collate(group_on(rolls, pins_per_frame), rolls_per_frame)
end

