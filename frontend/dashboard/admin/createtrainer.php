<?php
session_start();
if(!isset($_SESSION["email"])){
header("Location: ../../login.php");
exit();
}

require_once __DIR__ .'../../../../vendor/autoload.php';

use App\Models\Trainer;

$trainer = new Trainer();
$specializations = $trainer->getAllSpecializations();

if(isset($_POST["createTrainer"])){
    $lastname = $_POST["lastName"];
    $firstname = $_POST["firstName"];
    $specialization = $_POST["spec"];
    $rateperhour = $_POST["ratePerHour"];
    try{
        $trainer->createTrainer($lastname, $firstname, $specialization, $rateperhour);
        header("Location: admintrainers.php");
    }catch(PDOException $e){
        echo "Error creating a trainer.";
        echo $e->getMessage();
    }   
}
?>

<html>
    <head>
        <title>Big GainzFitness ADMIN - Trainer Creation</title>
    </head>
    <body>
        <h1>Create Trainer</h1>
        <form method="POST">
            <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" required>

            <label for="firstName">First Name</label>
                <input type="text" id="FirstName" name="firstName" required>

            <label for="spec">Specialization</label>
                <select id="spec" name="spec" required>
                    <option value="">--Select Specialization--</option>
                    <?php
                    if(empty($specializations)){
                    ?>
                    <option value="">--None found--</option>
                    <?php }else{
                        foreach($specializations as $spec){ ?>
                    <option value="<?php echo $spec["SpecType"]?>"><?php echo $spec["SpecDesc"]?></option>
                    <?php }
                    }?>
                </select>
            
            <label for="ratePerHour">Hourly Rate</label>
                <input type="text" id="ratePerHour" name="ratePerHour" value="300" required>

            <button type="submit" name="createTrainer">Create Trainer</button>
        </form>
        <a href="admintrainers.php"><button>BACK</button></a>
    </body>
</html>