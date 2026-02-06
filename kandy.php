<!DOCTYPE html>
<html>
<head>
<style>

body {
  background-color: #38444d;
}
.row {
  display: flex;
} 

.column-right{
  flex: 1; 
  padding: 10px; 
  background-color: #f0f0f0;
}

.column-left{
  flex: 1; 
  padding: 10px; 
  background-color: #d0d0d0;
  display: flex;
  justify-content: center;
  align-items: center; 
  flex-direction: column;
}

h1 {
  padding: 20px;
  text-align: center;
  color: white;
}


.dr {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

select {
  padding: 8px;
  width: 250px; 
  text-align: center; 
}


.btn {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 30px;
}

.button {
  font-size: 20px;
  border-radius: 12px;
  padding: 10px;
  margin: 0 auto;
  display: block;
}

.opt {
  font-size: 20px;
  padding: 10px;
  border-radius: 8px;
}

.img {
  width: 100%;
  height: 100%;
}

.output {
  font-size: 18px;
  margin-top: 20px;
  margin-left:35px;
  color: white;
}

.details {
  font-size: 26px;
  text-align: center;
}

.form-container {
  width: 100%;
  display: flex;
  justify-content: left;
  margin-top: 50px;
}

form {
  width: 300px;
}

.form-group {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
  align-items: left;
  color: white;
}

label {
  width: 120px;
  text-align: right;
  margin-right: 10px;
}

input[type="text"] {
  flex: 1;
  padding: 6px;
}

input[type="submit"] {
  display: block;
  margin: 20px auto 0;
  padding: 8px 20px;
}

h2 {
  margin: 80px 0 0 115px; 
  color: white;
}

h4 {
  font-weight: bold;
  font-size: 25px;
  margin-left: 20px;
  margin-bottom: 2px;
}

h5 {
  font-weight: bold;
  font-size: 25px;
  margin-left: 20px;
  margin-bottom: 0;
  color: white;
}


.page-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 100vh; 
  padding: 20px;
}

.image-right {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
}

.image-right img {
  max-height: 300px;
  width: auto;
  margin-right: 100px;
}


</style>
</head>
<body>
  <h1>Welcome to Kandy branch</h1>
<section class = "row"> 
<div class = "column-left">

  <h4>Select your doctor</h4>
<?php

$conn = new mysqli("localhost", "root", "", "hospital");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT Name_of_the_doctor FROM details_of_doctors";
$results = $conn->query($sql);
    
?>

<form method="post" action="">
  <div class = "dr">
    <select name="cat" class="opt">
        <?php
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                echo '<option value="' . $row["Name_of_the_doctor"] . '">' . $row["Name_of_the_doctor"] . '</option>';
            }
        }
        ?>
    </select>
      </div>
    <input type="submit" class= "button" value="Submit">
</form>
 
</div>
<div class = "column-right">
  <img src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQndQ28E9DHhxfD7jKpnVtIR6cz9oNElbrJPA&s" alt = "pic" class = "img">
</div>
</section>

<div class = "page-container">
  <div class = "content-left">

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cat'])) {
        $selectedNa = $_POST['cat'];
    } elseif (isset($_POST['selectedNa'])) {
        $selectedNa = $_POST['selectedNa'];
    }
    echo '<div class = "output"> You selected: Dr. ' . htmlspecialchars($selectedNa) . '</div>';
    


$conn = new mysqli("localhost", "root", "", "hospital");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT Specialization FROM details_of_doctors WHERE Name_of_the_doctor = '$selectedNa'";
$ts = $conn->query($sql);
    
if ($ts && $ts->num_rows > 0) {
    $row = $ts->fetch_assoc();
    $specialization = $row['Specialization'];
    echo '<div class="output"> Specialization: ' . htmlspecialchars($specialization) . '</div>';
} else {
    echo '<div class="output"> No specialization found for the selected doctor.</div>';
}

$sql = "SELECT Doctor_fee FROM details_of_doctors WHERE Name_of_the_doctor = '$selectedNa'";
$tms = $conn->query($sql);
    
if ($tms && $tms->num_rows > 0) {
    $row = $tms->fetch_assoc();
    $fee = $row['Doctor_fee'];
    echo '<div class="output"> Doctor fee: LKR ' . htmlspecialchars($fee) . '</div>';
} else {
    echo '<div class="output"> No specialization found for the selected doctor.</div>';
}

$hospitalCharges = 1000;
echo '<div class="output"> Hospital charges: LKR ' . htmlspecialchars($hospitalCharges) . '</div>';


$conn = new mysqli("localhost", "root", "", "hospital");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Available_date_and_time FROM availability WHERE Name_of_the_doctor = '$selectedNa'";
$result = $conn->query($sql);
}
?>
<h5>Select a date and a time</h5>;
<form method="post" action="">
  <div class= "dr">
    <select name="username">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["Available_date_and_time"] . '">' . $row["Available_date_and_time"] . '</option>';
            }
        }
        ?>
    </select>
<input type="hidden" name="selectedNa" value="<?= htmlspecialchars($selectedNa) ?>">
      </div>
    <input type="submit" class= "button" value="Submit">

</form>

<?php
$selectedName;
$selectedNa;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $selectedName = $_POST['username'];
    echo '<div class = "output"> You selected: ' . htmlspecialchars($selectedName) . '</div>';
}

$conn = new mysqli("localhost", "root", "", "hospital");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
global $selectedName;
global $selectedNa;

$sql = "SELECT No_of_appointments FROM availability WHERE Name_of_the_doctor = '$selectedNa' &&  Available_date_and_time = '$selectedName'";
$tt = $conn->query($sql);
    
if ($tt && $tt->num_rows > 0) {
    $row = $tt->fetch_assoc();
    $za = $row['No_of_appointments'];
    $an = ++$za;
    echo '<div class="output"> Your appointment number: ' . htmlspecialchars($an) . '</div>';

$update_sql = "UPDATE availability SET No_of_appointments = $za WHERE Name_of_the_doctor = '$selectedNa' AND Available_date_and_time = '$selectedName'";
$conn->query($update_sql);

}

?>
<h2>Enter Your Details</h2>
<div class= "form-container">

  <form method="post" action="receipt.php">

  <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name">
    </div>
    <div class="form-group">
      <label for="nic">NIC:</label>
      <input type="text" name="nic" id="nic">
    </div>
    <div class="form-group">
      <label for="number">Contact Number:</label>
      <input type="text" name="number" id="number">
    </div>
   
     <input type="hidden" name="selectedNa" value="<?php  
     $selectedNa;
     global $selectedNa;
     echo htmlspecialchars($selectedNa); ?>">

    <input type="hidden" name="selectedName" value="<?php  
     $selectedName;
     global $selectedName;
     echo htmlspecialchars($selectedName); ?>">

     <input type="hidden" name="an" value="<?php  
     $an;
     global $an;
     echo htmlspecialchars($an); ?>">

     <input type="hidden" name="fee" value="<?php  
     $fee;
     global $fee;
     echo htmlspecialchars($fee); ?>">

     <input type="hidden" name="hospitalCharges" value="<?php  
     $hospitalCharges;
     global $hospitalCharges;
     echo htmlspecialchars($hospitalCharges); ?>">

    <input type="submit" class="button" value="Submit">
  </form>
</div>
</div>
<div class="image-right">
  
  <img src="https://i.vimeocdn.com/video/1947651283-683b95ec53d4efd8768a580dfeb22bc654eb0e51e2ee5764e6f0346d797aa585-d?f=webp" alt="Right Image">
</div>
</div>

</body>
</html>        