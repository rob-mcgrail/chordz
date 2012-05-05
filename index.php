<?php
require_once __DIR__.'/vendor/silex.phar';
$app = new Silex\Application();

// Templating with twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));

require_once __DIR__.'/lib/chord_base.php';
require_once __DIR__.'/lib/chords.php';
require_once __DIR__.'/lib/wisdom.php';





/*

Application routes

For more information see:

http://silex.sensiolabs.org/doc/usage.html#routing

*/

$app->get('/{num}', function ($num) use ($app) {
    $key = 'g';
    $chords = new Chords($key);
    $sequence = $chords->random($num);
    $permalink = $app['request']->getHttpHost() . '/song/' . $chords->pattern;
    return $app['twig']->render('main.twig', array(
      'chords' => $sequence,
      'permalink' => $permalink,
      'wisdom' => $app['wisdom'],
    ));
})
->assert('num', '\d\d?')
->value('num', '4');


$app->get('/{num}/{key}', function ($num, $key) use ($app) {
    $chords = new Chords($key);
    $sequence = $chords->random($num);
    $permalink = $app['request']->getHttpHost() . '/song/' . $chords->pattern;

    return $app['twig']->render('main.twig', array(
      'chords' => $sequence,
      'permalink' => $permalink,
      'wisdom' => $app['wisdom'],
    ));
})
->assert('num', '\d\d?');


// Permalink route
$app->get('/song/{key}/{pattern}', function ($key, $pattern) use ($app) {
    $chords = new Chords($key);
    $sequence = $chords->byPattern($pattern);
    $permalink = $app['request']->getHttpHost() . '/song/' . $chords->pattern;

    return $app['twig']->render('main.twig', array(
      'chords' => $sequence,
      'permalink' => $permalink,
      'wisdom' => $app['wisdom'],
    ));
});



$app['debug'] = true;
$app->run();

?>
