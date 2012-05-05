<?php
class ChordBase {
/*

Base class for all chord getters.

Custom chord algorythms should inherit this class,
and implement a method returns and array of chords.

Every chord in the array should be created via the
getChord() method below. getChord() takes a numerical
string representation of a chord with a mode suffix.

Examples: "0", "5seven", "8m", "7sus" etc.

Note that calls to getChord() also append that chord to
$this->pattern, which is used to generate permalinks for your
chord sequence. Don't call getChord() unless you are adding a
chord to your final array, or your permalink will be broken.

Algorythms can access the current key via $this->key.

*/

  public $notes = array(
    'C', 'C#', 'D', 'D#', 'E', 'F',
    'F#', 'G', 'G#', 'A', 'A#', 'B',
  );

  public $pattern = '';

  function __construct($key) {
    $this->key = $this->cleanKey($key);
  }

  public function byPattern($pattern) {
    // Check if this is a full pattern with a key
    // if it is, update key var, and remove from pattern
    if (strpos($pattern, '/')) {
      $pattern_parts = explode('/', $pattern);
      $this->key = $this->cleanKey($pattern_parts[0]);
      $pattern = $pattern_parts[1];
    }
    $sequence = array();
    // Parse pattern and return items
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
    // get transpose ammount by index of note
    $offset = array_search($this->key, $this->notes, TRUE);
    // make sure we have plenty of notes to handle offset
    $notes = array_merge($this->notes, $this->notes);
    $parsed_note = $this->parseNote($note);
    // transpose note
    $k = $parsed_note['note'] + $offset;
    // add to premalink pattern
    $this->saveToPattern($parsed_note);
    // get transposed note
    $note = $notes[$k];
    // convert seven to 7 for display on the site
    $note = $note . str_replace('seven', '7', $parsed_note['mode']);
    return $note;
  }

  public function parseNote($note) {
    preg_match('/(\d+)(\w+)?/', $note, $matches);
#    $matches['2'] = str_replace('seven', '7', $matches[2]);
    return array('note' => $matches[1], 'mode' => $matches[2]);
  }

  public function cleanKey($key) {
    $key = strtoupper($key);
    return str_replace('SHARP', '#', $key);
  }
}
?>
