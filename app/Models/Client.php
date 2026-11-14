<?php

namespace App\Models;
use App\Database;
use PDO;

class Client{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn=$database->connect();
    }

    public function getClientByCurrentSession($email){
       try{
            $query = "SELECT * FROM user WHERE UserEmail = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$email]);
            $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $clientData;
       }catch(PDOException $e){
            echo "Error retrieving current session data";
            echo $e->getMessage();
       }
    }

    public function selectClientFromID($id){
        try{
            $query = "SELECT * FROM user WHERE UserID = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            $clientData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clientData;
        }catch(PDOException $e){
            echo "Error getting specific client data";
            echo $e->getMessage();
        }
    }

    public function getAllClients(){
        try{
            $query = "SELECT * FROM user";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        }catch(PDOException $e){
            echo "Error retrieving all clients";
            echo $e->getMessage;
        }
    }

    public function createClient($lastName, $firstName, $age, $gender, $weight, $height, $membershipType, $email, $password, $phoneNumber){
        try {
            $query = "INSERT INTO user (LastName, FirstName, UserAge, UserGender, UserWeight, UserHeight, MembershipType, UserEmail, UserPassword_hash, UserPhoneNo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$lastName, $firstName, $age, $gender, $weight, $height, $membershipType, $email, $password, $phoneNumber]);
            return $stmt->rowCount() > 0;
            echo json_encode(['message' => 'Client created successfully']);
        } catch (PDOException $e) {
            echo json_encode(['Error adding client' => $e->getMessage()]);
        }
    }

    public function updateClient($userEmail, $lastName, $firstName, $age, $gender, $weight, $height, $membershipType, $email, $phoneNumber){
        try{
            $query1 = "SELECT UserID FROM user WHERE UserEmail = ? LIMIT 1";
            $stmt1 = $this->conn->prepare($query1);
            $stmt1->execute([$userEmail]);
            $userID = $stmt1->fetchColumn();

            $query2 = "UPDATE user SET LastName = ?, FirstName = ?, UserAge = ?, UserGender = ?, UserWeight = ?, UserHeight = ?, MembershipType = ?, UserEmail = ?, UserPhoneNo = ? WHERE UserID = ?";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute([$lastName, $firstName, $age, $gender, $weight, $height, $membershipType, $email, $phoneNumber, $userID]);
            echo "Client updated successfully";
        }catch (PDOException $e){
            echo "Error updating client";
            echo $e->getMessage();
        }
        
    }

    public function deleteClient($id){
        try{
            $query = "DELETE FROM user WHERE userID = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$id]);
            echo json_encode(['message' => 'Client deleted successfully']);
        }catch(PDOException $e){
            echo "Error deleting client";
            echo $e->getMessage();
        }
    }

    public function getClientName($email){
        try{
            $query = "SELECT LastName, FirstName FROM user WHERE UserEmail = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row = $result){
                $lastName = $row['LastName'];
                $firstName = $row['FirstName'];
                echo "Welcome back, " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName);
            }else{
                echo "Error - user not found";
            }
        }catch(PDOException $e){
            echo "Error getting name of current session";
            echo $e->getMessage();
        }
    }
}

?>