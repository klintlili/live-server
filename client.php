<?php
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
require_once __DIR__ . '/Workerman/Autoloader.php';
$worker = new Worker();

$worker->onWorkerStart = function($worker){

    $con = new AsyncTcpConnection('ws://10.70.3.35:5550');

    $con->onConnect = function($con) {
        $con->send('hello');
    };

    $con->onMessage = function($con, $data) {
        echo 'reload';
    };

    $con->connect();
};

Worker::runAll();