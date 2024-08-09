<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

if (!empty($_POST["typeid"])) {

  $sql = mysqli_query($conn, "SELECT r_number,id from rooms where statue = 0 AND type ='" . $_POST['typeid'] . "' "); ?>
  <option selected="selected">Select Room</option>
  <?php
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['r_number']); ?></option>
  <?php
  } 
}

if (!empty($_POST["room"])) {

  $sql = mysqli_query($conn, "SELECT r_price from rooms where id='" . $_POST['room'] . "'"); ?>
  <?php
  while ($row = mysqli_fetch_array($sql)) { ?>
    <option value="<?php echo htmlentities($row['r_price']); ?>"><?php echo  htmlentities($row['r_price']); ?></option>
<?php
  }
}


?>

