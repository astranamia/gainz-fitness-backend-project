<?php
session_start();
if(!isset($_SESSION["email"])){
header("Location: ../../login.php");
exit();
}

require_once __DIR__ .'../../../../vendor/autoload.php';
use App\Models\Client;
use App\Models\Trainer;
use App\Models\Schedule;
$client = new Client();

try{
    $clients = $client->getAllClients();
}catch(PDOException $e){
    echo "Error getting all clients";
    $e->getMessage();
}

?>

<html>
    <head>
        <title>BigGainzFitness Admin Portal - Clients</title>
    </head>
    <body>
        <h1>CLIENTS</h1>
        <table>
            <tr>
                <th>Client ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Membership</th>
                <th>Actions</th>
            </tr>
            
            <?php
            
            if(empty($clients)){
            ?>
                <td colspan="7">No clients found!</td>

            <?php }else{
                foreach($clients as $client){
            ?>

            <tr>
                <td><?php echo $client["UserID"]?></td>
                <td><?php echo $client["LastName"]?></td>
                <td><?php echo $client["FirstName"]?></td>
                <td><?php echo $client["UserAge"]?></td>
                <td><?php echo $client["UserGender"]?></td>
                <td><?php echo $client["MembershipType"]?></td>
                <td><button onclick="return confirm('Are you sure? This permanently deletes the client and all their records.')">Delete Client</button></td>
            </tr>

            <?php
                    }
                }
            
            ?>
        </table>
        <a href="dashboard.php"><button>BACK</button></a>
    </body>
</html>