<?php
require_once __DIR__.'/vendor/silex.phar';
$app = new Silex\Application();

// Templating with twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));

require_once __DIR__.'/chords.php';
require_once __DIR__.'/wisdom.php';


// Application routes
// http://silex.sensiolabs.org/doc/usage.html#dynamic-routing
$app->get('/{num}', function ($num) use ($app) {
    $chords = new Chords();
    $sequence = $chords->choose('C', $num);
    return $app['twig']->render('main.twig', array(
      'chords' => $sequence,
      'wisdom' => $app['wisdom'],
    ));
})
->assert('num', '\d0?') # ensure num is a number 0-10
->value('num', '4'); # num value for homepage


$app->get('/{num}/{key}', function ($num, $key) use ($app) {
    $chords = new Chords();
    $sequence = $chords->choose($key, $num);
    return $app['twig']->render('main.twig', array(
      'chords' => $sequence,
      'wisdom' => $app['wisdom'],
    ));
});


$app['debug'] = true;
$app->run();

?>
