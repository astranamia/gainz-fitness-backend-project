<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../../login.php");
    exit();
}

require_once __DIR__ . '../../../../vendor/autoload.php';
use App\Models\Trainer;
use App\Models\Schedule;

$scheduleModel = new Schedule();
$trainerModel = new Trainer();
$schedules = [];

try {
    $schedules = $scheduleModel->getUserSchedule($_SESSION["email"]);
} catch (PDOException $e) {
    echo "Error retrieving schedule data: " . $e->getMessage();
}
?>

<html>
    <head>
        <title>Big GainzFitness - My Schedules</title>
    </head>
    <body>
        <h1>My Schedules</h1>

        <table>
            <tr>
                <th>Schedule ID</th>
                <th>User ID</th>
                <th>Trainer</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php if (empty($schedules)): ?>
                <tr>
                    <td colspan="7">No schedules found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($schedules as $row): ?>
                    <?php
                    $trainerData = null;
                    try {
                        // Fetch the trainer matching this specific schedule's TrainerID
                        $trainerResult = $trainerModel->selectTrainerFromID($row["TrainerID"]);
                        // Handle whether selectTrainerFromID returns a list of rows or a single row
                        $trainerData = isset($trainerResult[0]) ? $trainerResult[0] : $trainerResult;
                    } catch (PDOException $e) {
                        $trainerData = null;
                    }
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["ScheduleID"]); ?></td>
                        <td><?php echo htmlspecialchars($row["UserID"]); ?></td>
                        <td>
                            <?php
                            if (!empty($trainerData)) {
                                echo htmlspecialchars($trainerData["LastName"] . ", " . $trainerData["FirstName"]);
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($row["ScheduleStart"]); ?></td>
                        <td><?php echo htmlspecialchars($row["ScheduleEnd"]); ?></td>
                        <td><?php echo htmlspecialchars($row["AttendanceStatus"]); ?></td>
                        <td>
                            <a href="schedule.php?id=<?php echo urlencode($row["ScheduleID"]); ?>">
                                <button type="button">View Schedule</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <a href="createschedule.php"><button>Create Schedule</button></a>
        <a href="dashboard.php"><button>BACK</button></a>
    </body>
</html>