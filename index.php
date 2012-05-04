<?php
require_once __DIR__.'/vendor/silex.phar';
$app = new Silex\Application();

// Templating with twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));

require_once __DIR__.'/services.php';



// Application routes
// http://silex.sensiolabs.org/doc/usage.html#dynamic-routing
$app->get('/{num}', function ($num) use ($app) {
    $chords = $app['chords']; // get protected closure so we can pass in $num later
    return $app['twig']->render('main.twig', array(
      'chords' => $chords($num),
      'wisdom' => $app['wisdom'],
    ));
})
->assert('num', '\d0?') # ensure num is a number 0-10
->value('num', '4'); # num value for homepage




$app['debug'] = true;
$app->run();

?>
