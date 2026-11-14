<?php
session_start();
if(!isset($_SESSION["email"])){
header("Location: ../../login.php");
exit();
}

require_once __DIR__ .'../../../../vendor/autoload.php';
use App\Models\Client;
$client = new Client();

?>

<html>
    <head>
        <title>Big GainzFitness Portal</title>
    </head>
    <body>
        <h1>CLIENT PORTAL</h1>
         <?php $client->getClientName($_SESSION["email"]);?>
         <a href="myaccount.php">My Account</a>
         <a href="myschedules.php">My Schedules</a>
         <a href="../../logout.php"><button>Log Out</button></a>
    </body>
</html>