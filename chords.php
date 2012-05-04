<?php
// Services for use in routes

class ChordHelper {
  public $notes = array('C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B',);

  public function getChord($key, $note) {
    $offset = array_search($key, $this->notes);
    $notes = array_merge($this->notes, $this->notes);
    $parsed_note = $this->parseNote($note);
    $k = $parsed_note['note'] + $offset;
    $note = $notes[$k];
    $parsed_note['mode'] = str_replace('seven', '7', $parsed_note['mode']);
    return $note . $parsed_note['mode'];
  }

  public function parseNote($note) {
    preg_match('/(\d+)(\w+)/', $note, $matches);
    return array('note' => $matches[1], 'mode' => $matches[2]);
  }
}


class Chords extends ChordHelper {
  public $candidates = array('0', '5', '7seven', '7', 6, '4m', '9m', '2m', '4seven');

  public function choose($key, $num) {
    $key = strtoupper($key);
    $key = str_replace('SHARP', '#', $key);

    $sequence = array($this->getChord($key, 0));
    for($i = 2; $i <= $num; $i++) {
      $note = $this->candidates[array_rand($this->candidates)];
      array_push($sequence, $this->getChord($key, $note));
    }
  return $sequence;
  }
}

?>
