<?php
session_start();
if(!isset($_SESSION["email"])){
header("Location: ../../login.php");
exit();
}

require_once __DIR__ .'../../../../vendor/autoload.php';
use App\Models\Client;
$client = new Client();

try{
    $clientData = $client->getClientByCurrentSession($_SESSION["email"]);
}catch(PDOException $e){
    echo "Error retrieving your account data.";
    echo $e->getMessage();
}
?>

<html>
    <head>
        <title>Big GainzFitness - My Account</title>
    </head>
    <body>

        <h1>My Account</h1>
        <br>
        <h2>Personal Information</h2>
            <table>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                </tr>
                <tr>
                    <td><?php echo $clientData["LastName"];?></td>
                    <td><?php echo $clientData["FirstName"];?></td>
                </tr>
            </table>

            <br>

            <h2>Health Information</h2>
            <table>
                <tr>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th>Height</th>
                </tr>
                <tr>
                    <td><?php echo $clientData["UserAge"];?></td>
                    <td><?php echo $clientData["UserGender"];?></td>
                    <td><?php echo $clientData["UserWeight"] . "kg";?></td>
                    <td><?php echo $clientData["UserHeight"] . "cm";?></td>
                </tr>
            </table>

            <h2>Membership Information</h2>
            <table>
                <tr>
                    <th>Membership Type</th>
                </tr>
                <tr>
                    <td><?php echo $clientData["MembershipType"];?></td>
                </tr>
            </table>

            <h2>Contact Information</h2>
            <table>
                <tr>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
                <tr>
                    <td><?php echo $clientData["UserEmail"];?></td>
                    <td><?php echo $clientData["UserPhoneNo"];?></td>
                </tr>
            </table>

            <h2>Joined on: <?php echo $clientData["RegistrationDate"];?></h2>
        </table>

        <a href="editaccount.php"><button>Edit Account</button></a>
        <a href="dashboard.php"><button>BACK</button></a>
    </body>
</html>