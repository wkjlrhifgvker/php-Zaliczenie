<?php

declare(strict_types=1);

namespace App;

include('./src/View.php');

 class Controller
 {
    const DEFAULT_ACTION = 'list';
    private View $view;
    private array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->view = new View();
    }
    public function run(): void 
    {

    $viewParams = [];

    switch($this->action()){
        case 'create':
            $page = 'create';
            $created = false;
            $data = $this->getRequestPost();
            if(!empty($data)){
                    $viewParams = [
                        'title' => $data['title'],
                        'description' => $data['description'],
                    ];
                    $created = true;
                            }
                $viewParams['created'] = $created;
                break;
                default:
                $page = 'list';
                $viewParams['resultList'] = 'Wyświetlamy listę notatek';
        }



    $this->view->render($page, $viewParams);
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