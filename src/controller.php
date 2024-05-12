<?php

declare(strict_types=1);

namespace App;

include('./src/View.php');
require_once('./config/config.php');
require_once('./src/Database.php');

use App\Request;
use App\Exception\MotFoundException;

 class Controller
 {
    const DEFAULT_ACTION = 'list';
    private View $view;
    private Database $database;
    private Request $request;
    private static array $configuration = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View();
        $this->database = new Database (self::$configuration);
    }

    public static function initConfiguration(array $configuration): void 
    {
        self::$configuration = $configuration;
    }
    public function run(): void 
    {

    switch($this->action()){
        case 'create':
            $page = 'create';

            if($this->request->hasPost()){
                    $noteData = [
                        'title' => $this->request->postParam('title'),
                        'description' => $this->request->postParam('description'),
                    ];
                    $created = true;
                    $this->database->createNote($noteData);
                    header('Location: /?before=created');
                    exit;
                }
                break;
                case 'show':
                    $page = 'show';
                    $noteId = (int) $this->request->getParam ('id');
                    if (!$noteId) {
                        header('Loation: /?error=missingNoteId');
                        exit;
                    }
                    try {
                        $note = $this->database->getNote($noteId);
                    } catch (notFoundException $e) {
                        header ('Loation: /?error=noteNotFound');
                        exit;
                    }
                    $viewParams = [
                        'title' => 'Moja Notatka',
                        'description' => "Opis tej notatki zostal dodany w kodzie.",
                        'note' => $note,
                    ];
               
                break;
                default:
                $page = 'list';
                $viewParams = [
                    'notes' => $this->database->getNotes(),
                    'before' => $this->request->getParam('before'),
                    'error' => $this->request->getParam('error'),
                ];
        }



    $this->view->render($page, $viewParams ?? []);
        }
        private function action(): string 
        {
          return $this->request->getParam('action', self::DEFAULT_ACTION);
        }
    }