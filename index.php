<?php
declare(strict_types=1);

spl_autoload_register(function (string $name) {
    $name = str_replace(['\\', 'App/'], ['/', ''], $name);
    $path = "./src/$name.php";
    require_once($path);
});


include_once('./src/utils/debug.php');
require_once('./config/config.php');

use App\Exception\AppException;

use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use App\controller\NoteController;
use App\controller\AbstractController;
use App\Request;



try{
    AbstractController::initConfiguration($configuration);
    $request = new Request ($_GET, $_POST);
    $controller = new NoteController($request);
    $controller->run();

}catch(AppException $e) {
    echo "<h1>Błąd</h1>";
    echo "<h2>{$e->getMessage()}</h2>";
    dump($e);

}catch(\Throwable $e) {
    echo "<h1>wystąpił błąd, więcej nie powiem</h1>";
    dump($e);
};