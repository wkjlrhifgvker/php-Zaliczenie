<?php
declare(strict_types=1);

namespace App;

require_once('./src/controller.php');
include_once('./src/utils/debug.php');

// const DEAFULT_ACTION = 'list';

// $action = $_GET['action'] ?? DEAFULT_ACTION;

// $viewParams = [];

// switch($action){
//     case 'create':
//         $page = 'create';
//         $created = false;
//         if(!empty($_POST)){
//                 $viewParams = [
//                     'title' => $_POST['title'],
//                     'description' => $_POST['description'],
//                 ];
//                 $created = true;
//                         }
//             $viewParams['created'] = $created;
//             break;
//             default:
//             $page = 'list';
//             $viewParams['resultList'] = 'Wyświetlamy listę notatek';
//     }



// $view->render($page, $viewParams);
$controller = new Controller($_GET, $_POST);
$controller->run();