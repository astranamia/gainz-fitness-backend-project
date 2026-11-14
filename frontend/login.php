<?php
session_start();
require_once __DIR__ .'/../vendor/autoload.php';
use App\Controllers\Authentication;
$message = '';
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Authentication();
    $loginResult = $auth->clientLogin($email, $password);

    if($loginResult == "Login successful"){
        $_SESSION["email"]=$email;
        header("Location: dashboard/client/dashboard.php");
        exit();
    }elseif($loginResult == "Admin logged in"){
        $_SESSION["email"]=$email;
        header("Location: dashboard/admin/dashboard.php");
        exit();
    }else{
        $message = "Invalid email or password. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BIG Gainz Fitness - Login</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Orbitron:wght@800;900&family=Outfit:wght@400;600;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="login.css">
</head>
<body>

  <div class="login-page">
    <div class="left-box">
      <div class="form-wrapper">
        
        <a href="index.html" class="site-brand brand-logo">
          <span class="logo-icon">B<i class="fa-solid fa-dumbbell"></i>G</span>
          <span class="logo-text">GainzFitness</span>
        </a>

        <div class="top-text">
          <h1 class="page-title">Welcome back</h1>
          <p class="page-sub">Log in to continue your fitness journey.</p>
        </div>

        <form class="user-form" action="#" method="POST">
          <div class="input-group">
            <label for="user-email" class="field-label">Email Address</label>
            <div class="input-box">
              <i class="fa-regular fa-envelope field-icon"></i>
              <input type="email" id="user-email" class="user-input" name="email" placeholder="Enter your email" required>
            </div>
          </div>

          <div class="input-group">
            <label for="user-pass" class="field-label">Password</label>
            <div class="input-box">
              <i class="fa-solid fa-lock field-icon"></i>
              <input type="password" id="user-pass" class="user-input" name="password" placeholder="Enter your password" required>
              <i class="fa-regular fa-eye-slash hide-icon" onclick="
                const box = document.getElementById('user-pass');
                if (box.type === 'password') {
                  box.type = 'text';
                  this.classList.remove('fa-eye-slash');
                  this.classList.add('fa-eye');
                } else {
                  box.type = 'password';
                  this.classList.remove('fa-eye');
                  this.classList.add('fa-eye-slash');
                }
              "></i>
            </div>
          </div>

          <div class="extra-row">
            <a href="#" class="forgot-btn">Forgot Password?</a>
          </div>

          <button type="submit" class="submit-btn" name="login">Log In</button>
        </form>

        <div class="bottom-box">
          <p class="change-page">
            Don't have an account? <a href="signup.php" class="link-btn">Sign Up</a>
          </p>
          <p class="copy-text">© 2026 BigGainzFitness</p>
        </div>
      </div>
    </div>

    <div class="right-box">
      <div class="bg-overlay"></div>
    </div>
  </div>

</body>
</html>