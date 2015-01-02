<?php 
session_start(); 
if($_SESSION['logged'] != true) {
	header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . "login.php");	
}
?>
<div id="navbar">
    <ul id="main-navi">
        <li><a href="index.php">Front page</li>
        <li><a href="empty_form.php">Add new user</a></li>
        <li> <p>Signed in as <a href="user_page.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo $_SESSION['user']; ?></a></p></li>
	<li><p><a href="logout.php">Logout</a></p></li>
    </ul>
</div>
