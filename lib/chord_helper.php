<?php
class ChordHelper {
  public $notes = array(
    'C', 'C#', 'D', 'D#', 'E', 'F',
    'F#', 'G', 'G#', 'A', 'A#', 'B',
  );

  public function getChord($key, $note) {
    # get transpose ammount by index of note
    $offset = array_search($key, $this->notes, TRUE);
    # make sure we have plenty of notes to handle offset
    $notes = array_merge($this->notes, $this->notes);
    $parsed_note = $this->parseNote($note);
    # transpose note
    $k = $parsed_note['note'] + $offset;
    # get transposed note
    $note = $notes[$k];
    return $note . $parsed_note['mode'];
  }

  public function parseNote($note) {
    preg_match('/(\d+)(\w+)?/', $note, $matches);
    # Revert seven -> 7
    $matches['2'] = str_replace('seven', '7', $parsed_note['mode']);
    return array('note' => $matches[1], 'mode' => $matches[2]);
  }

  public function cleanKey($key) {
    # Upcase and replace sharp with #
    $key = strtoupper($key);
    return str_replace('SHARP', '#', $key);
  }
}
?>
