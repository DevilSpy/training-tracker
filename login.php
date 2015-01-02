<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap-3.1.1-dist/css/bootstrap.min.css" />
</head>

<body>

<?php 
require_once("dbinit.php"); 
session_start();
?>

<h2>Login</h2>

<form role="form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>"  class="form-horizontal">
	<div class="form-group">
    	<label for="inputEmail" class="col-md-offset-2 col-md-2 control-label">Email address</label>
        <div class="col-md-4">
        	<input type="email" class="form-control" id="inputEmail" name="email" />
    	</div>
    </div>
    <div class="form-group">
    	<label for="inputPassword" class="col-md-offset-2 col-md-2 control-label">Password</label>
        <div class="col-md-4">
        	<input type="password" class="form-control" id="inputPassword" name="password" />
    	</div>
    </div>
    <div class="form-group">
    	<div class="col-md-offset-7">
        	<button type="submit" name="login" class="btn btn-default">Login</button>
        </div>
    </div>
</form>

<?php

if(isset($_POST['login'])) {
	$email = $_POST['email'];
	$pwd = $_POST['password'];

	$sql = <<<SQLEND
		SELECT userid, email, password, level
		FROM users
		WHERE email = :email;
SQLEND;

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':email', "$email", PDO::PARAM_STR);
	//$stmt->bindValue(':pwd', "$pwd", PDO::PARAM_STR);
	$stmt->execute();
	$affected_rows = $stmt->rowCount();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$hash = $row['password'];
	/*if($affected_rows == 1) {
	/*	$_SESSION['logged'] = true;
		$_SESSION['user'] = $_POST['email'];
		$_SESSION['userid'] = $row['userid'];
		$_SESSION['level'] = $row['level'];
		header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . "index.php");
	} else {
		echo "<p>Email or password not correct</p>";	
	}*/

	if(password_verify($pwd, $hash) && $affected_rows == 1) {
		$_SESSION['logged'] = true;
                $_SESSION['user'] = $_POST['email'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['level'] = $row['level'];
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . "index.php");

	} else {
		echo "Email or password not correct";
	}

}


?>

<?php include_once("footer.php"); ?>

</body>
</html>
