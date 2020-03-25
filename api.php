<?php

namespace App;
require __DIR__ . '/vendor/autoload.php';

if (!isset($argv[1])) {
    echo 'parsing error';
    exit(0);
}
$path = __DIR__.'/data/'.$argv[1];

$data = json_decode(file_get_contents($path), true);
unlink($path);
$controller = new EventsController();
$controller->store($data);
