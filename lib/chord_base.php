<?php
class ChordBase {
  public $notes = array(
    'C', 'C#', 'D', 'D#', 'E', 'F',
    'F#', 'G', 'G#', 'A', 'A#', 'B',
  );

  public $pattern = '';

  function __construct($key) {
    $this->key = $this->cleanKey($key);
  }

  public function byPattern($pattern) {
    # pattern example: 0-2m-3seven
    $sequence = array();
    $pattern = explode('-', $pattern);
    foreach ($pattern as $value) {
      array_push($sequence, $this->getChord($value));
    }
    return $sequence;
  }

  public function saveToPattern($parsed_note) {
    $str = $parsed_note['note'] . $parsed_note['mode'];
    if (empty($this->pattern)) {
      $this->pattern = $this->key . '/' . $str;
    } else {
      $this->pattern = $this->pattern . '-' . $str;
    }
  }

  public function getChord($note) {
    # get transpose ammount by index of note
    $offset = array_search($this->key, $this->notes, TRUE);
    # make sure we have plenty of notes to handle offset
    $notes = array_merge($this->notes, $this->notes);
    $parsed_note = $this->parseNote($note);
    # transpose note
    $k = $parsed_note['note'] + $offset;
    # add to premalink pattern
    $this->saveToPattern($parsed_note);
    # get transposed note
    $note = $notes[$k];
    return $note . $parsed_note['mode'];
  }

  public function parseNote($note) {
    preg_match('/(\d+)(\w+)?/', $note, $matches);
    # Revert seven -> 7
    $matches['2'] = str_replace('seven', '7', $matches[2]);
    return array('note' => $matches[1], 'mode' => $matches[2]);
  }

  public function cleanKey($key) {
    # Upcase and replace sharp with #
    $key = strtoupper($key);
    return str_replace('SHARP', '#', $key);
  }
}
?>
