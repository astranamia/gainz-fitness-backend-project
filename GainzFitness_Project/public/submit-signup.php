<?php

require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\FormHandler;

$formHandler = new FormHandler();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formHandler->handleFormSubmission($_POST);
        if (isset($_POST['submit'])) {
            // Redirect to the success page after successful submission
            header("Location: signup-successful.html");
            exit();
        }else {
            // Handle the case where the form was not submitted via POST
            echo "Invalid request method.";
        }
    }
?>