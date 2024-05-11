<?php

declare(strict_types=1);

namespace App;
use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use Exception;
use PDO;
use PDOException;
use THrowable;

class Database
{
    private PDO $conn;
    public function __construct(array $config)
    {
        try{
            $this->createConnection($config);
            // $this->validateConfig($config);
            // $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
            // $connection = new PDO (
            //     $dsn,
            //     $config['user'],
            //     $config['password'],
            // );
            // $connection = new PDO('lalalalalala')
        }catch(PDOException $e){
            throw new StorageException("problem z połączeniem do bazy!");
        }
        
    } 

    public function createNote(array $data): void 
    {
        try{
            $title = $this->conn->quote($data['title']);
            $description = $this->conn->quote($data['description']);
            $created = date('Y-m-d H-i-s');
            $query = "INSERT INTO notes(title,description,created) VALUES ($title, $description, '$created')";
            $result = $this->conn->exec($query);
        }catch(Throwable $e) {
            throw new StorageException('nie udalo sie utowrzyc nowej notatki', 400, $e);
        }
    }
    public function createConnection(array $config): void 
    {
           $this->validateConfig($config);
            $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
            $this->conn = new PDO (
                $dsn,
                $config['user'],
                $config['password'],
            );
            // $connection = new PDO('lalalalalala')
    }
    private function validateConfig(array $config): void 
    {
        if(empty($config['database']) || empty($config['user']) || empty($config['host'])){
            throw new ConfigurationException("problem z configuracja bazy danych");
        }
    }
}