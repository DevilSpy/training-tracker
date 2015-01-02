<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
require_once("dbinit.php");

if(isset($_POST['save'])) {

	$stmt = $db->prepare("INSERT INTO exercise(date, hours, userid) VALUES(:date, :hours, :user)");
	$stmt->bindParam(':date', $date);
	$stmt->bindParam(':hours', $hours);
	$stmt->bindParam(':user', $user);

	$date = $_POST['date'];
	$hours = $_POST['hours'];
	$user = $_POST['userid'];

	$stmt->execute();

	header("Location: index.php");
}

?>

</body>
</html>
