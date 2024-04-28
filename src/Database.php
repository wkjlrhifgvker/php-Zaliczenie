<?php

declare(strict_types=1);

namespace App;
use App\Exception\ConfigurationExceptions;
use App\Exception\StorageExceptions;
use Exception;
use PDO;
use PDOException;

class Database
{
    public function __construct(array $config)
    {
        try{
            $this->validateConfig($config);
            $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
            $connection = new PDO (
                $dsn,
                $config['user'],
                $config['password'],
            );
            // $connection = new PDO('lalalalalala')
        }catch(PDOException $e){
            throw new StorageException("problem z połączeniem do bazy!");
        }
        
    } 
    private function validateConfig(array $config): void 
    {
        if(empty($config['database']) || empty($config['user']) || empty($config['host'])){
            throw new COnfigurationException("problem z configuracja bazy danych");
        }
    }
}