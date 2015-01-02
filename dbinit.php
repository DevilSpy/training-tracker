<?php
$db = new PDO('mysql:host=localhost;dbname=databasename;charset=utf8','username', 'password');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
