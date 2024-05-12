<?php
declare(strict_types=1);

namespace App;

require_once('./src/Request.php');
require_once('./src/controller.php');
include_once('./src/utils/debug.php');
require_once('./config/config.php');
require_once('./Exception/AppException.php');
require_once('./Exception/StorageException.php');
require_once('./Exception/ConfigurationException.php');

use App\Request;
use App\Exception\AppException;
use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use Throwable;


try{
    controller::initConfiguration($configuration);
    $request = new Request ($_GET, $_POST);
    $controller = new Controller($request);
    $controller->run();

}catch(AppException $e) {
    echo "<h1>Błąd</h1>";
    echo "<h2>{$e->getMessage()}</h2>";

}catch(Throwable $e) {
    echo "<h1>wystąpił błąd, więcej nie powiem</h1>";
};