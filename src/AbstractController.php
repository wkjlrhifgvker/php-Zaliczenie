<?php

declare(strict_types=1);

namespace App;

require_once('./config/config.php');
require_once('./src/Database.php');

use App\Request;
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
    
    private function action(): string 
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }
}