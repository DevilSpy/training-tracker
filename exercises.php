<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exercises</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
<link rel="stylesheet" type="text/css" href="styles/bootstrap-3.1.1-dist/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="scripts/bootstrap-select-master/bootstrap-select.min.css"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery-2.1.1.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/showDates.js"></script>
<script language="javascript" type="text/javascript" src="scripts/bootstrap-select-master/bootstrap-select.min.js"></script>

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

</head>

<?php 
	require_once("dbinit.php");
	include_once("navbar.php");
	include_once("functions.php");

	listExercises($db, false);
?>