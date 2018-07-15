<?php

namespace App\Core;

class Database
{

    private $host = 'localhost';
    private $dbName = 'payments';
    private $dbUser = 'root';
    private $dbPass = 'Publi2018';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        try {
            $this->conn = new PDO($dsn, $this->dbUser, $this->dbPass);
            $this->conn->setAttribute(PDO::ATT_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
