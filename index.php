<?php

require_once __DIR__.'/vendor/silex.phar';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

// Templating with twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));

// Music THEORY
$chords = array('A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#');
$modes = array('major' => '', 'minor' => 'm', 'seven' => '7');


// App
$app->get('/{num}', function ($num) use ($app, $chords, $modes) {
    // a dumb selector
    $sequence = array();
    for($i = 1; $i <= $num; $i++){
      $k = array_rand($chords);
      $chord = $chords[$k] . $modes[array_rand($modes)];
      unset($chords[$k]);
      array_push($sequence, $chord);
    }
    return $app['twig']->render('main.twig', array('chords' => $sequence));
})
->assert('num', '\d+')
->value('num', '4');



// Final things
$app['debug'] = true;
$app->run();

?>
