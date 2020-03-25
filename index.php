<?php declare(strict_types=1);

namespace App;

require __DIR__ . '/vendor/autoload.php';
session_start();
//размер потока
$all = 10000;
//количество в блоке
$blockSize = 1000;

$generator = new GeneratorHelper($blockSize);

try {
    for ($i = 0; $i < $all; $i += $blockSize) {
        //генерируем трафик ивентов
        $data = $generator->generate();
        //в фоне отправляем задачу на нашу "API"
        $requestId = 'request_' . $i;
        file_put_contents(__DIR__ . '/data/' . $requestId, json_encode($data));
        exec('bash runner.sh ' . $requestId);
        echo 'Send request for saving info about ' . count($data) .
            ' users with ' . $generator->getCounter() . ' uniq events'. PHP_EOL;
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
