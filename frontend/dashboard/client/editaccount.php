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

if(isset($_POST["updateclient"])){
    $userEmail = $_SESSION["email"];
    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    $membershipType = $_POST["membershipType"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    try{
        $client->updateClient($userEmail, $lastName, $firstName, $age, $gender, $weight, $height, $membershipType, $email, $phoneNumber);
        header("Location: myaccount.php");
    }catch(PDOException $e){
        echo "Error updating client.";
        echo $e->getMessage();
    }
}
?>

<html>
    <head>
        <title>Big GainzFitness - Edit Account</title>
    </head>
    <body>

        <h1>My Account</h1>
        <br>
        <h2>Personal Information</h2>

        <form method="POST">
            <table>
                <table>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="lastName" value="<?php echo $clientData["LastName"];?>"></input></td>
                        <td><input type="text" name="firstName" value="<?php echo $clientData["FirstName"];?>"></input></td>
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
                        <td><input type="number" name="age" value="<?php echo $clientData["UserAge"];?>"></input></td>
                        <td>
                            <select id="gender" name="gender" required>
                                    <option value=""></option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="O">Other</option>
                            </select>
                        </td>
                        <td><input type="number" id="weight" name="weight" value="<?php echo $clientData["UserWeight"];?>" required></input></td>
                        <td><input type="number" id="height" name="height" value="<?php echo $clientData["UserHeight"];?>" required></input></td>
                    </tr>
                </table>

                <h2>Membership Information</h2>
                <table>
                    <tr>
                        <th>Membership Type</th>
                    </tr>
                    <tr>
                        <td>
                            <select id="membershipType" name="membershipType" required>
                                <option value="<?php $clientData["MembershipType"];?>"><?php echo $clientData["MembershipType"];?></option>
                                <option value="BASIC">BASIC</option>
                                <option value="MID">MID</option>
                                <option value="PRO">PRO</option>
                            </select>

                        </td>
                    </tr>
                </table>

                <h2>Contact Information</h2>
                <table>
                    <tr>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" id="email" name="email" value="<?php echo $clientData["UserEmail"];?>" required></input>
                        </td>

                        <td>
                            <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $clientData["UserPhoneNo"];?>" required></input>
                        </td>
                    </tr>
                </table>
            </table>
            <button type="submit" name="updateclient">Save Changes</button>
        </form>

        
        <a href="myaccount.php"><button>BACK</button></a>
    </body>
</html>