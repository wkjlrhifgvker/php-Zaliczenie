<?php

declare(strict_types=1);

namespace App;

include('./src/View.php');
require_once('./config/config.php');
require_once('./src/Database.php');

use App\Exception\MotFoundException;

 class Controller
 {
    const DEFAULT_ACTION = 'list';
    private View $view;
    private Database $database;
    private array $request;
    private static array $configuration = [];

    public function __construct(array $request)
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

            $data = $this->getRequestPost();
            if(!empty($data)){
                    $noteData = [
                        'title' => $data['title'],
                        'description' => $data['description'],
                    ];
                    $created = true;
                    $this->database->createNote($noteData);
                    header('Location: /?before=created');
                    exit;
                }
                break;
                case 'show':
                    $page = 'show';
                    $data = $this->getRequestGet();
                    $noteId = (int) $data['id'] ?? null;
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
                $data = $this->getRequestGet();
                $viewParams = [
                    'notes' => $this->database->getNotes(),
                    'before' => $data['before'] ?? null,
                    'error' => $data['error'] ?? null,
                ];
        }



    $this->view->render($page, $viewParams ?? []);
        }
        private function action(): string 
        {
            $data = $this->getRequestGet();
            return $data['action'] ?? self::DEFAULT_ACTION;
        }
            private function getRequestGet(): array 
            {
                return $this->request['get'] ?? [];
            }
            private function getRequestPost(): array 
            {
                return $this->request['post'] ?? [];
            }
    }