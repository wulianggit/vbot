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
use Hanson\Robot\Support\Console;

$robot = new Robot([
    'tmp' => __DIR__ . '/./../tmp/',
]);

$robot->server->setMessageHandler(function($message){
    /** @var $message Message */
    // 发送撤回消息 （排除自己）
    print_r(http()->getClient()->getConfig('cookies')->toArray());
    if($message->type === 'Recall' && $message->rawMsg['FromUserName'] !== myself()->username){
        Console::log($message->content);
        Message::send($message->content, $message->username);
    }

});

$robot->server->run();