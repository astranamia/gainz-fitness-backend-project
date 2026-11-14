<?php

namespace App\Controllers;
use App\Database;
use PDO;

class Authentication{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn=$database->connect();
    }

    public function clientLogin($email, $password){
        $query = "SELECT * FROM user WHERE UserEmail = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['UserPassword_hash'])){
            if($user['isAdmin'] == 1){
                return "Admin logged in";
            }else{
                return "Login successful";
            }
        }else{
            return "Login failed";
        }
    }
}

?>