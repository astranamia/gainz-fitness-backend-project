<?php

namespace App\Models;
use App\Database;
use PDO;

class Schedule{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn=$database->connect();
    }

    public function getAllSchedules(){
        $query1 = "SELECT * FROM workoutschedule";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->execute();
        $schedules = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        return $schedules;
        //$query2 = "SELECT t.LastName, t.FirstName FROM trainer T INNER JOIN workoutschedule ws ON t.TrainerID = ws.TrainerID LIMIT 1";
        //$stmt2 =  $this->conn->prepare($query2);
        //$stmt2->execute();
        //$trainerName = $stmt2->fetch(PDO::FETCH_ASSOC);
        //return $trainerName;
    }

    public function getScheduleById($scheduleID, $email) {
    $query = "SELECT ws.* FROM workoutschedule ws
              INNER JOIN user u ON ws.UserID = u.UserID
              WHERE ws.ScheduleID = ? AND u.UserEmail = ? LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$scheduleID, $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserSchedule($email){
        try{
            try{
                //get userID first since session is email
                $query1 = "SELECT UserID FROM user WHERE UserEmail = ? LIMIT 1";
                $stmt1 = $this->conn->prepare($query1);
                $stmt1->execute([$email]);
                $userID = $stmt1->fetchColumn();
            }catch(PDOException $e){
                echo "Failed to get current user's ID.";
                echo $e->getMessage();
            }
            $query2 = "SELECT * FROM workoutschedule WHERE UserID = ?";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute([$userID]);
            $userSchedules = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            return $userSchedules;
        }catch(PDOException $e){
            echo "Failed to get current user's schedule";
            echo $e->getMessage();
        }
    }

    public function createSchedule($email, $trainerID, $scheduleStart, $scheduleEnd){
        try{
            //get userID first since session is email
            $query1 = "SELECT UserID FROM user WHERE UserEmail = ? LIMIT 1";
            $stmt1 = $this->conn->prepare($query1);
            $stmt1->execute([$email]);
            $userID = $stmt1->fetchColumn();
            //create the workout schedule
            $query2 = "INSERT INTO workoutschedule (UserID, TrainerID, ScheduleStart, ScheduleEnd) VALUES (?, ?, ?, ?)";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute([$userID, $trainerID, $scheduleStart, $scheduleEnd]);
            echo "Schedule created successfully!";
        }catch(PDOException $e){
            echo "Failed to create schedule.";
            echo $e->getMessage();
        }
    }

    public function updateClientSchedule($scheduleID, $email, $trainerID, $scheduleStart, $scheduleEnd) {
        try {
            $query1 = "SELECT UserID FROM user WHERE UserEmail = ? LIMIT 1";
            $stmt1 = $this->conn->prepare($query1);
            $stmt1->execute([$email]);
            $userID = $stmt1->fetchColumn();

            // Include ScheduleID = ? so only that specific row is modified
            $query2 = "UPDATE workoutschedule 
                       SET TrainerID = ?, ScheduleStart = ?, ScheduleEnd = ? 
                       WHERE ScheduleID = ? AND UserID = ?";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute([$trainerID, $scheduleStart, $scheduleEnd, $scheduleID, $userID]);
        } catch (PDOException $e) {
            throw $e;
        }
    }   

    public function deleteSchedule($id, $email) {
        try {
            // Fetch UserID using the session email
            $query1 = "SELECT UserID FROM user WHERE UserEmail = ? LIMIT 1";
            $stmt1 = $this->conn->prepare($query1);
            $stmt1->execute([$email]);
            $userID = $stmt1->fetchColumn();
    
            // Delete only if both ScheduleID and UserID match
            $query2 = "DELETE FROM workoutschedule WHERE ScheduleID = ? AND UserID = ?";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute([$id, $userID]);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function updateScheduleAttendance(){

    }
}

?>