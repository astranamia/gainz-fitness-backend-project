<?php

namespace app;
use PDO;

class Database {
    private $host = 'localhost';
    private $db_name = 'gym_database';
    private $username = 'root';
    private $password = '';

    public function connect():PDO{
        return new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    }
}


?>