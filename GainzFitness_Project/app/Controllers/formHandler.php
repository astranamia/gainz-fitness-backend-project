<?php

namespace App\Controllers;

use PDO;

class FormHandler
{
    private PDO $conn;
    
    public function __construct()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "gym_database";
        
        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function handleFormSubmission(array $postData): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 4. Collect and Validate Form Fields
            $lastName = trim($_POST['lastName'] ?? '');
            $firstName = trim($_POST['firstName'] ?? '');
            $age = trim($_POST['age'] ?? '');
            $gender = trim($_POST['gender'] ?? '');
            $weight = trim($_POST['weight'] ?? '');
            $height = trim($_POST['height'] ?? '');
            $membershipType = trim($_POST['membershipType'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phoneNumber = trim($_POST['phoneNumber'] ?? '');

            if (empty($firstName) || empty($lastName) || empty($email)) {
                die("Please fill in all required fields.");
            }

            // 5. Prepare the SQL Statement with Placeholders
            $sql = "INSERT INTO User (LastName, FirstName, UserAge, UserGender, UserWeight, UserHeight, MembershipType, UserEmail, UserPhoneNo) VALUES (:lastName, :firstName, :age, :gender, :weight, :height, :membershipType, :email, :phoneNumber)";
            $stmt = $this->conn->prepare($sql);

            // 6. Bind parameters and execute
            $stmt->execute([
                ':lastName' => $lastName,
                ':firstName' => $firstName,
                ':age' => $age,
                ':gender' => $gender,
                ':weight' => $weight,
                ':height' => $height,
                ':membershipType' => $membershipType,
                ':email' => $email,
                ':phoneNumber' => $phoneNumber
            ]);

            echo "Data successfully appended to the database!";
            header("Location: signup-successful.html");
            exit();
        }
    }
}
?>