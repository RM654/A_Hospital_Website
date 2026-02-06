<!DOCTYPE html>
<html>
<head>
<style>
</style>
</head>
<body>
<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $nic = test_input($_POST["nic"]);
  $number = test_input($_POST["number"]);

  echo "<h2>Your Submitted Details:</h2>";
  echo "Name: " . $name . "<br>";
  echo "NIC: " . $nic . "<br>";
  echo "Contact Number: " . $number . "<br>";
} else {
  echo "No data submitted.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedNa = $_POST['selectedNa'];
    echo "Name of the doctor: " . htmlspecialchars($selectedNa) . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedName = $_POST['selectedName'];
    echo "Appointment date and time: " . htmlspecialchars($selectedName) . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $an = $_POST['an'];
    echo "Appointment number: " . htmlspecialchars($an) . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fee = $_POST['fee'];
    echo "Doctor's fee: " . htmlspecialchars($fee) . "<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospitalCharges = $_POST['hospitalCharges'];
    echo "Hospital charges: " . htmlspecialchars($hospitalCharges) . "<br>";
}

$fee;
$hospitalCharges;
global $fee;
global $hospitalCharges;

echo "Total amount: ", ($fee + $hospitalCharges);


$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "hospital"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT room_number FROM details_of_doctors WHERE Name_of_the_doctor = '$selectedNa'";
$rr = $conn->query($sql);
    
if ($rr && $rr->num_rows > 0) {
    $row = $rr->fetch_assoc();
    $rrrn = $row['room_number'];
    echo '<div class="output"> Room number: ' . htmlspecialchars($rrrn) . '</div>';

}

?>
</body>
</html>