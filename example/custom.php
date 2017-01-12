<?php
/**
 * Created by PhpStorm.
 * User: HanSon
 * Date: 2016/12/7
 * Time: 16:33
 */

require_once __DIR__ . './../vendor/autoload.php';

use Hanson\Robot\Foundation\Robot;
use Hanson\Robot\Message\Message;

$robot = new Robot([
    'tmp' => __DIR__ . '/./../tmp/',
]);

$flag = false;

$robot->server->setCustomerHandler(function() use (&$flag){
    /** @var $message Message */

    if(!$flag){
        Message::send('custom', contact()->getUsernameById('L907159127'));
        $flag = true;
    }

    Message::send('测试' . \Carbon\Carbon::now()->toDateTimeString(), contact()->getUsernameById('L907159127'));

});

$robot->server->run();