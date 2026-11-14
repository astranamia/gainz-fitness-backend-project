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
$trainer = new Trainer();

try{
    $trainers = $trainer->getAllTrainers();
}catch(PDOException $e){
    echo "Error getting all trainers";
    $e->getMessage();
}

?>

<html>
    <head>
        <title>BigGainzFitness Admin Portal - Trainers</title>
    </head>
    <body>
        <h1>TRAINERS</h1>
        <table>
            <tr>
                <th>Trainer ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Specialization</th>
                <th>Hourly Rate</th>
                <th>Actions</th>
            </tr>
            
            <?php
            
            if(empty($trainers)){
            ?>
                <td colspan="6">No trainers found!</td>

            <?php }else{
                foreach($trainers as $trainer){
            ?>

            <tr>
                <td><?php echo $trainer["TrainerID"]?></td>
                <td><?php echo $trainer["LastName"]?></td>
                <td><?php echo $trainer["FirstName"]?></td>
                <td><?php echo $trainer["SpecializationType"]?></td>
                <td><?php echo $trainer["RatePerHour"]?></td>
                <td><button onclick="return confirm('Are you sure? This deletes the trainer and all of their records')">Delete Trainer</button></td>
            </tr>

            <?php
                    }
                }
            
            ?>
        </table>
        <a href="createtrainer.php"><button>Create Trainer</button></a>
        <a href="dashboard.php"><button>BACK</button></a>
    </body>
</html>