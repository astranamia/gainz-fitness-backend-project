<?php

require_once __DIR__.'/../vendor/autoload.php';
use App\Models\Client;

$client = new Client();
if(isset($_POST['signup'])){
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $membershipType = $_POST['membershipType'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phoneNumber = $_POST['phoneNumber'];

    // Call the createClient method to insert the data into the database
    if($client->createClient($lastName, $firstName, $age, $gender, $weight, $height, $membershipType, $email, $password, $phoneNumber)){
        echo "<script>alert('Client created successfully!'); window.location.href='signup-status/success.php';</script>";
        header("Location: signup-status/success.php");
        exit();
    } else {
        echo "<script>alert('Error creating client. Please try again.');</script>";
        header("Location: signup-status/failure.php");
        exit();
    }
}
?>

<html>
    <head>
        <title>GainzFitness - Membership Signup</title>
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=M+PLUS+1:wght@400;500&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Orbitron:wght@800;900&family=Oswald:wght@700&family=Outfit:wght@400;600;800;900&display=swap" rel="stylesheet">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body class="signup-body">
    <br>
    <br>
    <form method="POST" class="signup-form">
        <div class="signup-container">
            <div class="signup-content">
                <h1>Join Our Membership</h1>
                <p>Welcome to GainzFitness! Please fill out the form below to become a member and start your fitness journey with us.</p>
                <div class="sign-up-cards">
                    <!-- Step 1: Personal Information -->
                    <div class="sign-up-card active" id="step1">
                        <div class="card-header">
                            <h1>Step 1</h1>
                            <h2>Account Information</h2>
                            <p>Please provide your account details to get started.</p>
                        </div>

                        <div class="personal-form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="personal-form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <div class="personal-form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" required>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="next-btn">Next &rarr;</button>
                        </div>
                    </div>


                    <div class="sign-up-card" id="step2">
                        <div class="card-header">
                            <h1>Step 2</h1>
                            <h2>Personal and Health Information</h2>
                            <p>Please provide your basic personal and health details.</p>
                        </div>

                        <div class="personal-form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>

                        <div class="personal-form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>

                        <div class="personal-form-group">
                            <label for="age">Age</label>
                            <input type="number" id="age" name="age" required>
                        </div>

                        <div class="input-inline-group">
                            <label for="gender" id="gender-label">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="O">Other</option>
                            </select>
                            
                            <div class="personal-form-group" id="weight-group">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" id="weight" name="weight" required>
                            </div>
                            <div class="personal-form-group" id="height-group">
                                <label for="height">Height (cm)</label>
                                <input type="number" id="height" name="height" required>
                            </div>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="prev-btn">&larr; Back</button>
                            <button type="button" class="next-btn">Next &rarr;</button>
                        </div>

                    </div>


                    <!-- Step 3: Membership Details -->
                    <div class="sign-up-card" id="step3">
                        <div class="card-header">
                            <h1>Step 3</h1>
                            <h2>Membership Details</h2>
                            <p>Please provide your membership preferences.</p>
                        </div>
                        <div class="personal-form-group">
                            <label for="membershipType">Membership Type</label>
                            <select id="membershipType" name="membershipType" required>
                                <option value="">Select Membership Type</option>
                                <option value="BASIC">BASIC</option>
                                <option value="MID">MID</option>
                                <option value="PRO">PRO</option>
                            </select>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="prev-btn">&larr; Back</button>
                            <button type="button" class="next-btn">Next &rarr;</button>
                        </div>

                    </div>
                    <!-- Step 4: Contact Information -->
                    <div class="sign-up-card" id="step4">
                        <div class="card-header">
                            <h1>Step 4</h1>
                            <h2>Contact Information</h2>
                            <p>Please provide your contact details for communication.</p>
                        </div>

                        <div class="personal-form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" id="phoneNumber" name="phoneNumber" required>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="prev-btn">&larr; Back</button>
                            <button type="submit" name="signup" class="sign-up-button">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <script src="signup-script.js"></script>

    </body>
</html>