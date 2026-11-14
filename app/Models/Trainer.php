<?php

namespace App\Models;
use App\Database;
use PDO;

class Trainer{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn=$database->connect();
    }

    public function getAllTrainers(){
        try{
            $query = "SELECT * FROM trainer";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $trainers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $trainers;
        }catch(PDOException $e){
            echo "Error getting trainer data.";
            echo $e->getMessage();
        }
    }

    public function selectTrainerFromID($id){
        try{
            $query = "SELECT * FROM trainer WHERE TrainerID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            $trainers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $trainers;
        }catch(PDOException $e){
            echo "Error getting trainer data.";
            echo $e->getMessage();
        }
    }

    public function getAllSpecializations(){
        try{
            $query = "SELECT * FROM specialization";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $specializations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $specializations;
        }catch(PDOException $e){
            echo "Error fetching trainer specializations.";
            echo $e->getMessage();
        }

    }

    public function createTrainer($lastname, $firstname, $specialization, $rateperhour){
        try{
            $query = "INSERT INTO trainer (LastName, FirstName, SpecializationType, RatePerHour) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$lastname, $firstname, $specialization, $rateperhour]);
            return "Trainer added successfully!";
        }catch(PDOException $e){
            echo "Error adding trainer.";
            echo $e->getMessage();
        }
    }

    public function updateTrainer($lastname, $firstname, $specialization, $rateperhour){
        try{

        }catch(PDOException $e){
            echo "Error updating trainer.";
            echo $e->getMessage();
        }
    }

    public function deleteTrainer($id){
        try{
            $query = "DELETE FROM trainer WHERE TrainerID = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return "Trainer deleted successfully.";
        }catch(PDOException $e){
            echo "Error deleting trainer.";
            echo $e->getMessage();
        }
    }

    
}  

?>