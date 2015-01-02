<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User page</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap-3.1.1-dist/css/bootstrap.min.css" />
</head>

<body>

<?php 
require_once("dbinit.php"); 
include_once("navbar.php");


$id = $_GET['id'];
$sql = <<<SQLEND
	SELECT * FROM users WHERE userid = :userid;
SQLEND;

$stmt = $db->prepare($sql);
$stmt->bindValue(':userid', $id, PDO::PARAM_STR);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$fname = $row['firstname'];
$lname = $row['lastname'];
$email = $row['email'];
$number = $row['number'];
$address = $row['address'];
$city = $row['city'];
$postal = $row['postal'];
$belt = $row['belt'];

$white = "";
$yellow = "";
$green = "";
$blue = "";
$bluered = "";
$brown = "";
$red = "";
$redblack = "";
$dan1 = "";
$dan2 = "";
$dan3 = "";
$dan4 = "";

$selected = $row['belt'];
$$selected = "selected";

?>

<div id="user_form">
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="form-horizontal" role="form">
	<div class="form-group">
    	<label for="inputFName" class="col-md-offset-2 col-md-2 control-label">First name:</label>
        <div class="col-md-4">
        	<input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" required />
      	</div>
  	</div>
    <div class="form-group">
    	<label for="inputLName" class="col-md-offset-2 col-md-2 control-label">Last name:</label>
        <div class="col-md-4">
        	<input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>" required />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputEmail" class="col-md-offset-2 col-md-2 control-label">Email:</label>
        <div class="col-md-4">
        	<input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputNumber" class="col-md-offset-2 col-md-2 control-label">Phone number:</label>
        <div class="col-md-4">
        	<input type="text" name="number" class="form-control" value="<?php echo $number; ?>" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputAddress" class="col-md-offset-2 col-md-2 control-label">Address:</label>
        <div class="col-md-4">
        	<input type="text" name="address" class="form-control" value="<?php echo $address; ?>" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputCity" class="col-md-offset-2 col-md-2 control-label">City:</label>
        <div class="col-md-4">
        	<input type="text" name="city" class="form-control" value="<?php echo $city; ?>" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputPostal" class="col-md-offset-2 col-md-2 control-label">Postal code:</label>
        <div class="col-md-4">
        	<input type="text" name="postal" class="form-control" value="<?php echo $postal; ?>" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputBelt" class="col-md-offset-2 col-md-2 control-label">Belt:</label>
        <div class="col-md-4">
        	<select class="form-control" name="belt">
                <option <?php echo $white; ?> value="white">White</option>
                <option <?php echo $yellow; ?> value="yellow">Yellow</option>
                <option <?php echo $green; ?> value="green">Green</option>
                <option <?php echo $blue; ?> value="blue">Blue</option>
                <option <?php echo $bluered; ?> value="bluered">BlueRed</option>
                <option <?php echo $brown; ?> value="brown">Brown</option>
                <option <?php echo $red; ?> value="red">Red</option>
                <option <?php echo $redblack; ?> value="redblack">RedBlack</option>
                <option <?php echo $dan1; ?> value="dan1">1 Dan</option>
                <option <?php echo $dan2; ?> value="dan2">2 Dan</option>
                <option <?php echo $dan3; ?> value="dan3">3 Dan</option>
                <option <?php echo $dan4; ?> value="dan4">4 Dan</option>
            </select>
        </div>
    </div>
    <div class="form-group">
    	<div class="col-md-offset-7">
        	<button type="submit" name="save" class="btn btn-default">Save</button>
        </div>
    </div>
</form>
</div>

<?php

if(isset($_POST['save'])) {

	$stmt = $db->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, number = ?, address = ?, city = ?, postal = ?, belt = ? WHERE userid = ?");
	$stmt->bindParam(1, $fname);
    $stmt->bindParam(2, $lname);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $number);
   	$stmt->bindParam(5, $address);
   	$stmt->bindParam(6, $city);
    $stmt->bindParam(7, $postal);
    $stmt->bindParam(8, $belt);
	$stmt->bindParam(9, $id);

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$number = $_POST['number'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$postal = $_POST['postal'];
	$belt = $_POST['belt'];

	$stmt->execute();

        $time = time();

	header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/user_page.php?id=' . $id . '&time=' . $time);
	exit();

}

?>

<?php include_once("footer.php"); ?>

</body>
</html>
