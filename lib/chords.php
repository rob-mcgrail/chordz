<?php
class Chords extends ChordBase {
  public $candidates = array(
    '0', '0', '5', '5', '5', '5',
    '7', '7', '7', '7seven', '2m',
    '4m', '9m', '9m', '4seven',
  );

  public function random($key, $num) {
    $key = $this->cleanKey($key);
    # Start sequence with root
    $sequence = array($this->getChord($key, '0'));
    for($i = 2; $i <= $num; $i++) {
      # Append random chords to sequence
      $note = $this->candidates[array_rand($this->candidates)];
      array_push($sequence, $this->getChord($key, $note));
    }
  return $sequence;
  }

#  public function byPattern($key, $num) {
#    $key = $this->cleanKey($key);
#  }
}
?>
