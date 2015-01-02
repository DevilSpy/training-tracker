<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Empty form</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap-3.1.1-dist/css/bootstrap.min.css" />
</head>

<body>

<?php 
require_once("dbinit.php"); 
include_once("navbar.php");
?>

<h2>Add new user</h2>

<div id="empty_form">
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="form-horizontal" role="form">
	<div class="form-group">
    	<label for="inputFName" class="col-md-offset-2 col-md-2 control-label">First name:</label>
        <div class="col-md-4">
        	<input type="text" name="fname" class="form-control" required />
      	</div>
  	</div>
    <div class="form-group">
    	<label for="inputLName" class="col-md-offset-2 col-md-2 control-label">Last name:</label>
        <div class="col-md-4">
        	<input type="text" name="lname" class="form-control" required />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputEmail" class="col-md-offset-2 col-md-2 control-label">Email:</label>
        <div class="col-md-4">
        	<input type="email" name="email" class="form-control" required />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputNumber" class="col-md-offset-2 col-md-2 control-label">Phone number:</label>
        <div class="col-md-4">
        	<input type="text" name="number" class="form-control" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputAddress" class="col-md-offset-2 col-md-2 control-label">Address:</label>
        <div class="col-md-4">
        	<input type="text" name="address" class="form-control" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputCity" class="col-md-offset-2 col-md-2 control-label">City:</label>
        <div class="col-md-4">
        	<input type="text" name="city" class="form-control" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputPostal" class="col-md-offset-2 col-md-2 control-label">Postal code:</label>
        <div class="col-md-4">
        	<input type="text" name="postal" class="form-control" />
        </div>
    </div>
    <div class="form-group">
    	<label for="inputBelt" class="col-md-offset-2 col-md-2 control-label">Belt:</label>
        <div class="col-md-4">
        	<select class="form-control" name="belt">
                <option value="white">White</option>
                <option value="yellow">Yellow</option>
                <option value="green">Green</option>
                <option value="blue">Blue</option>
                <option value="bluered">BlueRed</option>
                <option value="brown">Brown</option>
                <option value="red">Red</option>
                <option value="redblack">RedBlack</option>
                <option value="1dan">1 Dan</option>
                <option value="2dan">2 Dan</option>
                <option value="3dan">3 Dan</option>
                <option value="4dan">4 Dan</option>
            </select>
        </div>
    </div>
    <div class="form-group">
    	<div class="col-md-offset-7">
        	<button type="submit" name="submit_form" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
</div>

<?php

if(isset($_POST['submit_form'])) {

	$stmt = $db->prepare("INSERT INTO users(firstname, lastname, email, number, address, city, postal, belt) VALUES (:fname, :lname, :email, :number, :address, :city, :postal, :belt)");
	$stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':postal', $postal);
        $stmt->bindParam(':belt', $belt);

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $postal = $_POST['postal'];
        $belt = $_POST['belt'];

	$stmt->execute();

}
?>

<?php include_once("footer.php"); ?>

</body>
</html>
