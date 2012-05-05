<?php
/*

A Silex shared service which returns a random quote.
http://silex.sensiolabs.org/doc/services.html#shared-services

*/

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
    'Chords from the same key will sound good with each other. How do I know which chords are in a key?',
    'i finally understand what the circle of fifths is for now',
    'What I really want to know is...DO YOU HAVE ANY OTHER APPLICATIONS, INSIGHTS, OR REVELATIONS YOU CAN TELL US ABOUT THE CIRCLE OF FIFTHS? ',
    'Well here\'s my question, I\'ve seen songs with chords outside of the key like in C major, an A7 chord?',
    'Hey, How do I know which chords will work with each other?  Thanks!',
    'If you took a music box apart, you\'d find that there\'s a tiny cylinder inside that is covered with tiny little bumps, or pins.',
    'So, you want to learn about the musical device known as harmony. What is harmony? You should have listened to at least one song, and then realized the vocal(s), guitar, and bass were playing different notes. If you haven’t, then you’re not attentive',
  );
  return $wisdom[array_rand($wisdom)];
});

?>
