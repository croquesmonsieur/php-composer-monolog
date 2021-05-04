<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';
require 'buttons.html';

use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\NativeMailerHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


// create a log channel
$log = new Logger('test');

$log->pushHandler(new StreamHandler('path/to/info.log', Logger::INFO));
$log->pushHandler(new StreamHandler('path/to/warning.log', Logger::WARNING));
$log->pushHandler(new StreamHandler('path/to/emergency.log', Logger::EMERGENCY));

// add records to the log
if (isset($_GET['message']) && isset($_GET['type'])) {
    $message = $_GET['message'];
    var_dump($message);
    switch ($_GET['type']) {
        case ('DEBUG'):
            $log->pushhandler(new BrowserConsoleHandler());
            $log->debug($message);
            break;
        case ('INFO'):
            $log->info($message);
            break;
        case ('NOTICE'):
            $log->notice($message);
            break;
        case ('WARNING'):
            $log->warning($message);
            break;
        case ('ERROR'):
            $log->error($message);
            break;
        case ('CRITICAL'):
            $log->pushHandler(new NativeMailerHandler('jan@pimpel.be', 'new error', 'test'));
            $log->critical($message);
            break;
        case ('ALERT'):
            $log->pushHandler(new NativeMailerHandler('jan@pimpel.be', 'new error', 'test'));
            $log->alert($message);
            break;
        case ('EMERGENCY'):
            $log->emergency($message);
    }
}








