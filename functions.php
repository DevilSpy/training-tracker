<?php
	// List recent exercises
	function recentExercises($db) { ?>
		
		<h3>Recent exercises</h3>
	<?php
		$sql= "SELECT DISTINCT date FROM exercise ORDER BY date DESC LIMIT 6"; 

		$stmt = $db->prepare($sql);
		$stmt->execute();
	?>
		<div id='exercises'>
	<?php
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$date = $row['date'];
			echo "<p><a href='#' class='exercise' id='exercisedate{$date}'>" . $date . "</a></p>";
			
			$sql2="SELECT users.firstname, exercise.hours FROM exercise INNER JOIN users ON exercise.userid=users.userid WHERE exercise.date='$date' ORDER BY firstname ASC";	
			$stmt2 = $db->prepare($sql2);
			$stmt2->execute();
			echo "<div id='participants{$date}'>";
			echo "<p>";
			while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
				echo  $row2['firstname'] . " (" . $row2['hours'] .  "h)  ";
			}
			echo "</p></div>";

		}
		
		
		?>
		</div>
		<?php
	}
?>

<?php
	// List all exercises in links
	function allExercises($db) { 

		$sql= "SELECT DISTINCT date FROM exercise ORDER BY date DESC";
		$stmt = $db->prepare($sql);
		$stmt->execute();
	?>
		<div id='exercises'>
	<?php
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$date = $row['date'];
			echo "<p><a href='#' class='exercise' id='exercisedate{$date}'>" . $date . "</a></p>";
			
			$sql2="SELECT users.firstname, exercise.hours FROM exercise INNER JOIN users ON exercise.userid=users.userid WHERE exercise.date='$date' ORDER BY firstname ASC";	
			$stmt2 = $db->prepare($sql2);
			$stmt2->execute();
			echo "<div id='participants{$date}'>";
			echo "<p>";
			while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
				echo  $row2['firstname'] . " (" . $row2['hours'] .  "h)  ";
			}
			echo "</p></div>";

		}
		
		
		?>
		</div>
		<?php
	}
?>

<?php 
	// List all exercises in table
	function listExercises($db, $limit) {

		if ($limit == false) {
			$sql = "SELECT DISTINCT date FROM exercise ORDER BY date DESC"; 
		} else {
			$sql = "SELECT DISTINCT date FROM exercise ORDER BY date DESC LIMIT 4";
		}
		$stmt = $db->prepare($sql);
		$stmt->execute();

		?>

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			<table class="exercisesTable">
				<tr>
					<th>Date</th>
					<th>Participants</th>
					<th>Hours</th>
				</tr>
		<?php

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$date = $row['date'];
			
			$sql2="SELECT users.firstname, exercise.hours FROM exercise INNER JOIN users ON exercise.userid=users.userid WHERE exercise.date='$date' ORDER BY firstname ASC";	
			$stmt2 = $db->prepare($sql2);
			$stmt2->execute();

			$count = $stmt2->rowCount();

			$set = false;
			while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
				$fname = $row2['firstname'];
				$hours = $row2['hours'];
				
				if ($set == false) {
					echo "<tr><th rowspan=" . $count . ">" . $date . "</th>";
					$set = true;	
				} 

				echo "<td>" . $fname . "</td><td>" . $hours . "</td></tr>"; 
			}

		}

			 
	?>
		</table>
		</div>
		</div>

	<?php	
	}
?>

<?php
	// Latest input 
	function latestInput($db) { 

		$sql = "SELECT date FROM exercise ORDER BY date DESC LIMIT 0, 1";
		$stmt = $db->prepare($sql);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$eid = $row['date'];

		echo "<h4>Latest training input: ".  $eid . "</h4>";
	}
?>

<?php 
	// List all users
	function listUsers($db) {

		$sql = "SELECT userid, firstname, lastname FROM users WHERE active = 1 ORDER BY firstname ASC";
		$stmt = $db->prepare($sql);
		$stmt->execute();

		?>

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			<table class="usersTable">
				<tr>
					<th>Name</th>
					<th>Total hours</th>
				</tr>
		<?php

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$id = $row['userid'];
			$name = $row['firstname'] . " " . $row['lastname'];

			$sql2 = "SELECT SUM(hours)AS hours FROM exercise WHERE userid=:userid";
			$stmt2 = $db->prepare($sql2);
			$stmt2->bindParam(':userid', $id);
			$stmt2->execute();

			?>

		

			<?php
			while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
				$hours = $row2['hours'];
				echo "<tr><td><a href='user_page.php?id=" . $id . "'>" . $name . "</a></td><td>" . $hours . "</td></tr>";
			}

			 
		}
		?>
		</table>
		</div>
		</div>

	<?php	
	}
?>

<?php 
	// Get user's info
	function getUserInfo($db, $id) {
		$sql = "SELECT * FROM users WHERE userid = :userid";

		$stmt = $db->prepare($sql);
		$stmt->bindValue(':userid', $id, PDO::PARAM_STR);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$fname = $row['firstname'];
		$lname = $row['lastname'];
		$email = $row['email'];
		$number = $row['number'];
		$address = $row['address'];
		$city = $row['city'];
		$postal = $row['postal'];
		$belt = $row['belt'];

		// create user object
		$user = new stdClass();
		$user->name = $fname . " " . $lname;
		$user->fname = $fname;
		$user->lname = $lname;
		$user->email = $email;
		$user->number = $number;
		$user->address = $address;
		$user->city = $city;
		$user->postal = $postal;
		$user->belt = $belt;

		return $user;
	}
?>

<?php 
	// Get user's total training hours
	function getUserHours($db, $id) {
		$sql = "SELECT SUM(hours)AS hours FROM exercise WHERE userid=:userid";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':userid', $id);
		$stmt->execute();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$hours = $row['hours'];
			return $hours;
		}
	}
?>

<?php 
	// Get training hours by month
	function getUserHoursMonth($db, $id, $date) {

		$sql = "SELECT date, hours FROM exercise WHERE userid=:userid AND date LIKE :date";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':userid', $id);
		$stmt->bindParam(':date', $date);
		$stmt->execute();

		$exercise = array();
		$hoursArray = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$date = $row['date'];
			$hours = $row['hours'];

			$exercise[$date] = $hours;
			
			array_push($hoursArray, floatval($hours));
		}

		/*foreach($exercise as $d => $h) {
			echo $d . " " . $h . "\n";
		}*/

		echo json_encode($hoursArray);
	}
?>

<?php 
	// Get user's training hours as year as months
	function getYearAsMonths($db, $id, $year) {

		$yearArray = array();

		for ($i=1; $i<13; $i++) {
			$year = $year;
			if ($i < 10) {
				$date = $year . "-0" . $i . "-%";
			} else {
				$date = $year . "-" . $i . "-%";
			}

			// don't show the first logged bulk hours
			if($date == "2014-07-%") {

				$hours = null;
				array_push($yearArray, floatval($hours));


			} else {	
		
				$sql = "SELECT SUM(hours) AS hours FROM exercise WHERE userid=:userid AND date LIKE :date";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':userid', $id);
				$stmt->bindParam(':date', $date);
				$stmt->execute();


				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$hours = $row['hours'];
					array_push($yearArray, floatval($hours));
				}

			}
		}


		echo json_encode($yearArray);
	}
?>
