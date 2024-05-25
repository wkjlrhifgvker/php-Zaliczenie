<?php

declare(strict_types=1);

namespace App\Controller;


use App\Request;
use App\Database;
use App\View;
use App\Exception\NotFoundException;

class AbstractController
{
    const DEFAULT_ACTION = 'list';
    protected View $view;
    protected Database $database;
    protected Request $request;
    protected static array $configuration = [];

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
        $action = $this->action() . 'Action';
        if(!method_exists($this, $action)) {
            $action = self::DEFAULT_ACTION . 'Action';
        }
        $this->$action();
    }
    
    protected function redirect (string $to, array $params): void 
    {
        $location = $to;
        if(count($params)) {
            $queryParams = [];
            foreach($params as $key => $value) {
                $queryParams[] = urlencode($key) . '=' . urlencode($value);
            }
            $queryParams = implode('&', $queryParams);
            $location .= '?' . $queryParams;
        }
        header("Location: $location");
        exit;
    }
    private function action(): string 
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }
}