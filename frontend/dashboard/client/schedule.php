<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../../login.php");
    exit();
}

require_once __DIR__ . '../../../../vendor/autoload.php';
use App\Models\Trainer;
use App\Models\Schedule;

// Redirect back if no schedule ID is provided in the URL
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: myschedules.php");
    exit();
}

$scheduleID = $_GET["id"];
$trainerModel = new Trainer();
$scheduleModel = new Schedule();
$trainers = $trainerModel->getAllTrainers();

// Handle Update
if (isset($_POST["updatesched"])) {
    $email = $_SESSION["email"];
    $postScheduleID = $_POST["scheduleID"];
    $trainerID = $_POST["trainer"];
    $scheduleStart = $_POST["scheduleStart"];
    $scheduleEnd = $_POST["scheduleEnd"];

    try {
        $scheduleModel->updateClientSchedule($postScheduleID, $email, $trainerID, $scheduleStart, $scheduleEnd);
        header("Location: myschedules.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating schedule: " . $e->getMessage();
    }
}

// Handle Delete
if (isset($_POST["deletesched"])) {
    $postScheduleID = $_POST["scheduleID"];
    $email = $_SESSION["email"];
    try {
        $scheduleModel->deleteSchedule($postScheduleID, $email);
        header("Location: myschedules.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting schedule: " . $e->getMessage();
    }
}

// Fetch ONLY the specific schedule requested in ?id=
$currentSchedule = null;
try {
    $currentSchedule = $scheduleModel->getScheduleById($scheduleID, $_SESSION["email"]);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<html>
<head>
    <title>Big GainzFitness - My Workout Schedules</title>
</head>
<body>
    <h1>My Workout Schedule</h1>

    <?php if (!$currentSchedule): ?>
        <p>Workout schedule not found or you do not have permission to view it.</p>
    <?php else: ?>
        <form method="POST">
            <input type="hidden" name="scheduleID" value="<?php echo htmlspecialchars($currentSchedule['ScheduleID']); ?>">

            <label for="trainer">Select Trainer</label>
            <select id="trainer" name="trainer" required>
                <option value="">-- Select a Trainer --</option>
                <?php if (empty($trainers)): ?>
                    <option value="">No trainers found!</option>
                <?php else: ?>
                    <?php foreach ($trainers as $t): ?>
                        <?php $selected = ($t["TrainerID"] == $currentSchedule["TrainerID"]) ? "selected" : ""; ?>
                        <option value="<?php echo htmlspecialchars($t["TrainerID"]); ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($t["LastName"] . " " . $t["FirstName"]); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <label for="scheduleStart">Schedule Start</label>
            <input type="datetime-local" id="scheduleStart" name="scheduleStart" value="<?php echo date('Y-m-d\TH:i', strtotime($currentSchedule['ScheduleStart'])); ?>" required>

            <label for="scheduleEnd">Schedule End</label>
            <input type="datetime-local" id="scheduleEnd" name="scheduleEnd" value="<?php echo date('Y-m-d\TH:i', strtotime($currentSchedule['ScheduleEnd'])); ?>" required>

            <button type="submit" name="updatesched" class="create-schedule-button">Update Schedule</button>
            <button type="submit" name="deletesched" class="delete-schedule-button" onclick="return confirm('Are you sure?')">Delete Schedule</button>
        </form>
    <?php endif; ?>

    <a href="myschedules.php"><button type="button">BACK</button></a>
</body>
</html>