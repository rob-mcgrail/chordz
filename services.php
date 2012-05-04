<?php
// Services for use in routes

// http://silex.sensiolabs.org/doc/services.html#service-definitions
// http://silex.sensiolabs.org/doc/services.html#shared-services
$app['wisdom'] = $app->share(function() {
  $wisdom = array(
    'A chord in every pot, a chord on every plate!',
    'Chords... inscrutable fingerful boxes. Pointlessly cruel.',
    'Something else about chords why not?',
  );
  return $wisdom[array_rand($wisdom)];
});

// http://silex.sensiolabs.org/doc/services.html#protected-closures
$app['chords'] = $app->protect(function($num) {
  // Music THEORY
  $sequence = array();
  $chords = array('A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#');
  $modes = array('major' => '', 'minor' => 'm', 'seven' => '7');
  for($i = 1; $i <= $num; $i++){
    $k = array_rand($chords);
    $chord = $chords[$k] . $modes[array_rand($modes)];
    array_push($sequence, $chord);
    unset($chords[$k]); # prevent repeat chords...
  }
  return $sequence;
});

?>
