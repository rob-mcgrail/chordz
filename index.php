<?php
require_once __DIR__.'/vendor/silex.phar';
$app = new Silex\Application();

// Templating with twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__.'/views',
    'twig.class_path' => __DIR__.'/vendor/twig/lib',
));

require_once __DIR__.'/lib/chord_helper.php';
require_once __DIR__.'/lib/chords.php';
require_once __DIR__.'/lib/wisdom.php';





// Application routes
// http://silex.sensiolabs.org/doc/usage.html#dynamic-routing
$app->get('/{num}', function ($num) use ($app) {
    $chords = new Chords();
    $sequence = $chords->choose('G', $num);
    return $app['twig']->render('main.twig', array(
      'chords' => $sequence,
      'wisdom' => $app['wisdom'],
    ));
})
# ensure num is a number 0-99
->assert('num', '\d\d?')
# num default value for empty routes
->value('num', '4');


# Should be able to combine these two routes somehow...
$app->get('/{num}/{key}', function ($num, $key) use ($app) {
    $chords = new Chords();
    $sequence = $chords->choose($key, $num);
    return $app['twig']->render('main.twig', array(
      'chords' => $sequence,
      'wisdom' => $app['wisdom'],
    ));
})
# ensure num is a number 0-99
->assert('num', '\d\d?');





$app['debug'] = true;
$app->run();

?>
