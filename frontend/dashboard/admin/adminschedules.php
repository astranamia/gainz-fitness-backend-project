<?php
session_start();
if(!isset($_SESSION["email"])){
header("Location: ../../login.php");
exit();
}

require_once __DIR__ .'../../../../vendor/autoload.php';
use App\Models\Schedule;
use App\Models\Client;
use App\Models\Trainer;

$schedule = new Schedule();
$trainer = new Trainer();
$client = new Client();

try{
    $schedules = $schedule->getAllSchedules();
}catch(PDOException $e){
    echo "Error getting all workout schedules";
    echo $e->getMessage();
}
?>

<html>
    <head>
        <title>Big GainzFitness ADMIN - ALL Schedules</title>
    </head>
</html>
<body>
    <form method = "POST">
        <table>
            <tr>
                <th>Schedule ID</th>
                <th>Client</th>
                <th>Trainer</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Attendance Status</th>
                <th>Actions</th>
            </tr>
            <?php if(empty($schedules)){
            ?>

            <tr>
                <td colspan="7">No workout schedules found!</td>
            </tr>

            <?php 
            }else{
                foreach($schedules as $schedule){?>

            <tr>
                <td><?php echo $schedule["ScheduleID"]?></td>
                <?php
                $clientData = $client->selectClientFromID($schedule["UserID"]);
                foreach($clientData as $clients){
                ?>
                <td><?php echo $clients["LastName"] . ", " . $clients["FirstName"];?></td>
                <?php } ?>
                <?php
                $trainerData = $trainer->selectTrainerFromID($schedule["TrainerID"]);
                foreach($trainerData as $trainers){
                ?>
                <td><?php echo $trainers["LastName"] . ", " . $trainers["FirstName"];?></td>
                <?php } ?>
                <td><?php echo $schedule["ScheduleStart"];?></td>
                <td><?php echo $schedule["ScheduleEnd"];?></td>
                <td>
                    <select id="attendance" name="attendanceStatus" required>
                        <option value="<?php echo htmlspecialchars($schedule["AttendanceStatus"]); ?>"><?php echo htmlspecialchars($schedule["AttendanceStatus"]); ?></option>
                        <option value="ATTENDED">ATTENDED</option>
                        <option value="ABSENT">ABSENT</option>
                    </select>
                </td>
                <td><button type="submit" name="setattendance">Set Attendance</button></td>
            </tr>

            <?php
                }
            }?>    
        </table>
    </form>
    <a href="dashboard.php"><button>BACK</button></a>
</body>