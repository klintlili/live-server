<?php

use Workerman\Worker;

require_once __DIR__ . '/vendor/autoload.php';

// Create a Websocket server
$ws_worker = new Worker('websocket://0.0.0.0:5550');

// 4 processes
$ws_worker->count = 4;

$prevTime = filemtime(__DIR__);
$ws_worker->onWorkerStart = function($worker) use (&$prevTime){
    \Workerman\Lib\Timer::add(1, function()use($worker, &$prevTime){
       $time = filemtime(__DIR__);
       if($time != $prevTime){
           $prevTime = $time;
            foreach($worker->connections as $connection) {
                $connection->send('reloadsss');
            }
       }
       clearstatcache(__DIR__);
    });
};

// Emitted when new connection come
$ws_worker->onConnect = function ($connection) {
    echo "New connection\n";
};

// Emitted when data received
$ws_worker->onMessage = function ($connection, $data) use ($ws_worker) {
    foreach ($ws_worker->connections as $connection){
        $connection->send('reload');
    }
};

// Emitted when connection closed
$ws_worker->onClose = function ($connection) {
    echo "Connection closed\n";
};

// Run worker
Worker::runAll();