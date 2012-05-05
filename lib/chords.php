<?php
class Chords extends ChordBase {
/*

Simple random chord-getter example.

Returns the root chord for the key,
and $num ammount of random chords
slected from the $this->candidates array.

*/

  public $candidates = array(
    '0', '0', '5', '5', '5', '5',
    '7', '7', '7', '7seven', '2m',
    '4m', '9m', '9m', '4seven',
  );

  public function random($num) {
    // Always start sequence with root chord
    $sequence = array($this->getChord('0'));
    for($i = 2; $i <= $num; $i++) {
      // Append random chords to sequence
      $note = $this->candidates[array_rand($this->candidates)];
      array_push($sequence, $this->getChord($note));
    }
  return $sequence;
  }
}
?>
