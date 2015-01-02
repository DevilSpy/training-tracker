<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change password</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap-3.1.1-dist/css/bootstrap.min.css" />
</head>

<body>

<h2>Change password</h2>

<?php 
require_once("dbinit.php"); 

$form = <<<FORMEND
<form method="POST" action="change_pwd.php" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="inputEmail" class="col-md-offset-2 col-md-2 control-label">Email:</label>
		<div class="col-md-4">
			<input type="email" id="email" name="email" class="form-control" required />
		</div>
	</div>
	<div class="form-group">
		<label for="inputOldPwd" class="col-md-offset-2 col-md-2 control-label">Current password:</label>	
		<div class="col-md-4">
			<input type="password" id="oldPwd" name="oldPwd" class="form-control" required />
		</div>
	</div>
	<div class="form-group">
		<label for="inputNewPwd" class="col-md-offset-2 col-md-2 control-label">New password:</label>
		<div class="col-md-4">
			<input type="password" id="newPwd" name="newPwd" class="form-control" required />
		</div>
	</div>
	<div class="form-group">
		<label for="inputNewPwdAgain" class="col-md-offset-2 col-md-2 control-label">New password again:</label>
		<div class="col-md-4">
			<input type="password" id="newPwdAgain" name="newPwdAgain" class="form-control" required />
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-offset-7">
			<button type="submit" name="changePwd" class="btn btn-default">Change</button>
		</div>
	</div>
</form>
FORMEND;

echo $form;

if(isset($_POST['changePwd'])) {
	
	if ($_POST['newPwd'] != $_POST['newPwdAgain']) {
	 	echo "Passwords don't match";
		exit();	
	} else if ($_POST['newPwd'] == $_POST['newPwdAgain']) {
		$stmt = $db->prepare("SELECT userid, email, password, level FROM users WHERE email = :email");
		$stmt->bindParam(':email', $email);
		//$stmt->bindParam(':pwd', $pwd);
		
		$email = $_POST['email'];
		$pwd = $_POST['oldPwd'];
		
		$stmt->execute();
		
		$affected_rows = $stmt->rowCount();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$newPwd = $_POST['newPwd'];
		$userid = $row['userid'];
		$hash = $row['password'];
		
		if(password_verify($pwd, $hash) && $affected_rows == 1) {
			$stmt = $db->prepare("UPDATE users SET password = ? WHERE userid = ?");
			$stmt->bindParam(1, $hashed);
			$stmt->bindParam(2, $userid);
			
			$password = $newPwd;
			
			$hashed = password_hash($password, PASSWORD_DEFAULT);
			
			$stmt->execute();
			
			echo "Password changed";
		} else  if($pwd == $hash) {
                        $stmt = $db->prepare("UPDATE users SET password = ? WHERE userid = ?");
                        $stmt->bindParam(1, $hashed);
                        $stmt->bindParam(2, $userid);

                        $password = $newPwd;

                        $hashed = password_hash($password, PASSWORD_DEFAULT);

                        $stmt->execute();

                        echo "Password changed";
                }

	}
}

?>


</body>
</html>
