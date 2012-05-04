<?php
// Services for use in routes

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


// http://silex.sensiolabs.org/doc/services.html#service-definitions
// http://silex.sensiolabs.org/doc/services.html#shared-services
$app['wisdom'] = $app->share(function() {
  $wisdom = array(
    'A chord in every pot, a chord on every plate!',
    'Chords... inscrutable fingerful boxes. Pointlessly cruel.',
    'Something else about chords why not?',
    'I like chords that are very lush with all the lush parts taken out.',
    'If it has more than three chords, it\'s jazz.',
    'If you play more than two chords, you\'re showing off.',
    'Sometimes you stumble across a few chords that put you in a reflective place.',
    'I know there are non-believers out there, so I checked Freddie\'s chord voicings using audio analysis software and found that Freddie does indeed play one-note chords.',
    'Hi guys, I\'m trying to learn guitar. I\'m brand new. I\'m working on G, Em, C and D7th.',
    'They got some chords. If anyone knows of some better site, plz email me too =p',
    ' I WOULD REALLY LIKE TO THE GET THE GUITAR TABS FOR THE SONGS IN THE MOVIE "MY CAPE OF MANY DREAMS". IT WOULD BE REALLY NICE.EVER SINCE I WAS KID I GREW UP WITH LISTENING TO THE GUITAR IN THIS MOVIE. I REALLY THINK YOU GUYS FOR HELPING.',
    'You can\'t always write a chord ugly enough to say what you want to say',



  );
  return $wisdom[array_rand($wisdom)];
});

?>
