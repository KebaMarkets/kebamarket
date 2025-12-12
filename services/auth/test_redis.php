<?php

$redis = new Redis();
$redis->connect(getenv('REDIS_HOST'), getenv('REDIS_PORT'));

$redis->set('ping', 'pong');
echo $redis->get('ping') . PHP_EOL;
