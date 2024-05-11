<?php
declare(strict_types=1);

namespace App;

require_once('./src/controller.php');
include_once('./src/utils/debug.php');
require_once('./config/config.php');
require_once('./Exception/AppException.php');
require_once('./Exception/StorageException.php');
require_once('./Exception/ConfigurationException.php');

use App\Exception\AppException;
use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use Throwable;


try{
    controller::initConfiguration($configuration);
    $request = [
    'get' => $_GET,
    'post' => $_POST,
    ];
    $controller = new Controller($request);
    $controller->run();

}catch(AppException $e) {
    echo "<h1>Błąd</h1>";
    echo "<h2>{$e->getMessage()}</h2>";
    dump($e);

}catch(Throwable $e) {
    echo "<h1>wystąpił błąd, więcej nie powiem</h1>";
    dump($e);

};