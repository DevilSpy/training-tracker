<h3>Recent exercises</h3>

<?php
	$sql=<<<SQLEND
		SELECT DISTINCT date FROM exercise ORDER BY date DESC LIMIT 6; 
SQLEND;

	$stmt = $db->prepare($sql);
	$stmt->execute();
	
	echo "<div id='exercises'>";
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$date = $row['date'];
		echo "<a href='#' class='exercise' id='exercisedate{$date}'>" . $date . "</a>";
		
		$sql2="SELECT users.firstname, exercise.hours FROM exercise INNER JOIN users ON exercise.userid=users.userid WHERE exercise.date='$date' ORDER BY firstname ASC";	
		$stmt2 = $db->prepare($sql2);
		$stmt2->execute();
		echo "<div id='participants{$date}'>";
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
			echo $row2['firstname'] . "(" . $row2['hours'] .  "h)  ";
		}
		echo "</div>";
	}
	
	
	echo "</div>";
?>
