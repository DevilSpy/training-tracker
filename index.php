<?php 
	$title = "Training tracker";
	include_once("head.php");
?>


<script type="text/javascript">
	$(window).on('load', function () {
		$('.selectpicker').selectpicker();
	});
</script>

</head>

<body>
<?php 
require_once("dbinit.php");
include_once("navbar.php");
include_once("functions.php"); 
?>

<h2>Haedong Kumdo Jyväskylä Training Tracker</h2>

<div class="container">

<!--?php latestInput($db); ?-->

<h3>Add exercise with multiple users at once</h3>

<div class="container">
<!-- add multiple at once -->
<div class="exerciseSetter">
	<form method="POST" action="saveMultipleToDB.php" class="form-inline" role="form">
			<div class="form-group">
				<label for="inputDate">Date:</label>
					<input type="date" id="date" name="date" class="form-control" required />
			</div>
			<div class="form-group">
				<label for="inputHours">Hours:</label>
					<input type="number" min="0.5" max="10" step="0.5" id="hours" name="hours" required />
			</div>
			<div class="form-group">
				<label for="users">Users:</label>
					<select class="selectpicker" multiple name="users[]">
                    <?php
						$sql = <<<SQLEND
						SELECT * FROM users WHERE active = 1 ORDER BY firstname;
SQLEND;
					$stmt = $db->prepare($sql);
					$stmt->execute();

					while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
						$id = $row['userid'];
						$fname = $row['firstname'];
						echo "<option value='" . $id . "'>" . $fname . "</option>";
					}
					?>
	   				</select>
			</div>
			<div class="form-group">
				<div>
					<button type="submit" name="save" class="btn btn-default">Save</button>
				</div>
    	</div>
		</form>
</div>

	<h4>Recent exercises</h4>
	<?php listExercises($db, true); ?>
</div>

<!-- LIST RECENT EXERCISES -->
<!--?php include_once("listParticipants.php"); ?-->
<!--?php recentExercises($db); ?-->

 

<!-- ADD ONE USER AT A TIME -->
<!--h3 id="addusersclick"><a href="#">Add one user at a time</a></h3>
<input type="button" class="showDates" value="Show all dates" id="allUserDates" />
<!--?php
// add one at a time

$sql = <<<SQLEND
	SELECT * FROM users WHERE active=1 ORDER BY firstname;
SQLEND;
$stmt = $db->prepare($sql);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
	$userLink = "<a href='user_page.php?id={$row['userid']}'>{$row['firstname']}</a>";
	
	// submit form
	$form = <<<FORMEND
	<form method="POST" action="saveToDB.php" class="form-inline" role="form" id="trainingInputForm">
		<input type="hidden" name="userid" value="{$row['userid']}">
		<div class="form-group">
			<label for="inputDate">Date:</label>
				<input type="date" id="date" name="date" class="form-control" required />
		</div>
		<div class="form-group">
			<label for="inputHours">Hours:</label>
				<input type="number" min="0.5" max="100" step="0.5" id="hours" name="hours" required />
		</div>
	    <div class="form-group">
    		<div>
        		<button type="submit" name="save" class="btn btn-default">Save</button>
        	</div>
    	</div>
	</form>
FORMEND;

	$stmt2 = $db->query("SELECT SUM(hours)AS hours FROM exercise WHERE userid='{$row['userid']}'");
	$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	$sum = $row2['hours'];
	
	echo "<div class='user'><div class='userLine container'><div id='userline' class='fixedwidth'>" . $userLink  . "</div><div id='userline'>" . $form . "</div><div id='userline' class='fixedwidth'> Total hours:  " . $sum . "</div><input type='button' class='showDates' value='Show Dates' id='userDates{$row['userid']}'></div></div>";
	
	
	// all exercises user has taken
	$sql2 = <<<SQLEND
		SELECT date, hours FROM exercise WHERE userid='{$row['userid']}' ORDER BY date DESC LIMIT 5;
SQLEND;

	$stmt3 = $db->prepare($sql2);
	$stmt3->execute();
	
	echo "<div id='dates{$row['userid']}'>";
	
	while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
		$dates = $row3['date'];
		$hours = $row3['hours'];
	
		echo "<div class='dateLine'><div id='dateline'>Date: " . $dates . "</div><div id='dateline'> Hours: " . $hours . "</div></div>";
	}
	
	echo "</div>";
}


?>

</div-->

<?php include_once("footer.php"); ?>


</body>
</html>
