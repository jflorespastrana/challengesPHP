<?php
// First, run 'composer require pusher/pusher-php-server'
require __DIR__ . '/vendor/autoload.php';

$pusher = new Pusher\Pusher(
    "ba083468e5e4d707cce8", // Replace with 'key' from dashboard
    "e1a52a95ee00b93c157d", // Replace with 'secret' from dashboard
    "1352750", // Replace with 'app_id' from dashboard
    array(
        'cluster' => 'eu' // Replace with 'cluster' from dashboard
    )
);
// Trigger a new random event every second. In your application,
// you should trigger the event based on real-world changes!
while (true) {
    $pusher->trigger('price-btcusd', 'new-price', array(
        'value' => rand(0, 5000)
    ));
    sleep(1);
}
