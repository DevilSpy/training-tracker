<?php 
	require_once("dbinit.php");
	include_once("functions.php");
	$id = $_GET['id'];
	$year = $_GET['year'];
	getYearAsMonths($db, $id, $year); 
?>