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
$trainer = new Trainer();
$schedule = new Schedule();

$trainers = $trainer->getAllTrainers();

if(isset($_POST["createsched"])){
    $email = $_SESSION["email"];
    $trainerID = $_POST["trainer"];
    $scheduleStart = $_POST["scheduleStart"];
    $scheduleEnd = $_POST["scheduleEnd"];
    try{
        $schedule->createSchedule($email, $trainerID, $scheduleStart, $scheduleEnd);
        echo "Schedule created successfully!";
        header("Location: myschedules.php");
    }catch(PDOException $e){
        echo "Error creating workout schedule. Please try again.";
        echo $e->getMessage();
    }
}

?>

<html>
    <head>
        <title>Big GainzFitness - Create Schedule</title>
    </head>
    <body>
        <h1>Create Schedule</h1>

        <form method="POST">
            <label for="trainer" id="trainer">Select Trainer</label>
                <select id="trainer" name="trainer" required>
                    <option value="">-- Select a Trainer --</option>
                    <?php  
                    if(empty($trainers)){
                    ?>
                    <option value="">No trainers found!</option>
                    <?php }else{
                        foreach($trainers as $trainer){
                    ?>
                    <option value="<?php echo $trainer["TrainerID"];?>"><?php echo $trainer["LastName"] . " " . $trainer["FirstName"];?></option>
                    <?php
                        }
                    }   
                    ?>
                </select>

                <label for="scheduleStart" id="scheduleStart">Schedule Start</label>
                    <input type="datetime-local" id="scheduleStart" name="scheduleStart" required>

                <label for="scheduleEnd" id="scheduleEnd">Schedule End</label>
                    <input type="datetime-local" id="scheduleEnd" name="scheduleEnd" required>

                <button type="submit" name="createsched" class="create-schedule-button">CREATE</button>
        </form>

        <a href="dashboard.php"><button>BACK</button></a>
    </body>
</html>