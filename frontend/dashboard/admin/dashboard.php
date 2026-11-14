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
        <title>BigGainzFitness Admin Portal</title>
    </head>
    <body>
        <h1>ADMIN PORTAL</h1>
        <?php $client->getClientName($_SESSION["email"]);?>
        <a href="adminclients.php">CLIENTS</a>
        <a href="admintrainers.php">TRAINERS</a>
        <a href="adminschedules.php">SCHEDULES</a>
        <br>
        <a href="../../logout.php"><button>Log Out</button></a>
    </body>
</html>