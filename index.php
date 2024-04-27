<?php
declare(strict_types=1);

namespace App;

require_once('./src/View.php');
include_once('./src/utils/debug.php');

const DEAFULT_ACTION = 'list';

$action = $_GET['action'] ?? DEAFULT_ACTION;

$viewParams = [];

if($action === 'create') {
    $page = 'create';
    $viewParams['resultCreate'] = 'Udało się dodać notatkę!';
} else {
    $page = 'list';
    $viewParams['resultList'] = 'Wyświetlamy nową notatkę!';
}


$view = new View();
$view->render($page, $viewParams);
?>