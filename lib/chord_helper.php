<?php
class ChordHelper {
  public $notes = array(
    'C', 'C#', 'D', 'D#', 'E', 'F',
    'F#', 'G', 'G#', 'A', 'A#', 'B',
  );

  public function getChord($key, $note) {
    $offset = array_search($key, $this->notes, TRUE);
    $notes = array_merge($this->notes, $this->notes);

    $parsed_note = $this->parseNote($note);

    $k = $parsed_note['note'] + $offset;
    $note = $notes[$k];
    $parsed_note['mode'] = str_replace('seven', '7', $parsed_note['mode']);
    return $note . $parsed_note['mode'];
  }

  public function parseNote($note) {
    preg_match('/(\d+)(\w+)?/', $note, $matches);
    return array('note' => $matches[1], 'mode' => $matches[2]);
  }

  public function cleanKey($key) {
    $key = strtoupper($key);
    return str_replace('SHARP', '#', $key);
  }
}
?>
