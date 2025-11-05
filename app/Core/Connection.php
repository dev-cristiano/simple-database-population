<?php

namespace App\Core;
use PDO;

class Connection extends \PDO
{
    private string $host;
    private string $user;
    private string $password;
    private string $database;
    private string $port;
    private ?PDO $pdo = null;
    public function __construct(
        ?string $host = null,
        ?string $user = null,
        ?string $password = null,
        ?string $database = null,
        ?string $port = null,
    )
    {
        $this->host     = $host     ?? $_ENV['DB_HOST']     ?? 'localhost';
        $this->user     = $user     ?? $_ENV['DB_USER']     ?? 'root';
        $this->password = $password ?? $_ENV['DB_PASS']     ?? '';
        $this->database = $database ?? $_ENV['DB_NAME']     ?? '';
        $this->port     = $port     ?? $_ENV['DB_PORT']     ?? '3306';
    }

    public function connecting(): PDO
    {
        if ($this->pdo === null) {
            try {
                $dsn = "mysql:host=$this->host;dbname=$this->database;port=$this->port";
                $this->pdo = new PDO($dsn, $this->user, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (\PDOException $e) {
                throw new \RuntimeException('Erro ao conectar ao banco: ' . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}