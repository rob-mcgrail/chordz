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

// music info

$chords = array('A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#');
$modes = array('major' => '', 'minor' => 'm', 'seven' => '7');


// App
$app->get('/', function () use ($app, $chords, $modes) {
    // a dumb selector
    $indexes = array_rand($chords, 4);
    $sequence = array();
    foreach( $indexes as $key => $value){
	     array_push($sequence, $chords[$value]);
    }
    return $app['twig']->render('hello.twig', array('chords' => $sequence));
});



// Final things
$app['debug'] = true;
$app->run();

?>
