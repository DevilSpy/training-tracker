<?php

$sql = <<<SQLEND
        SELECT date FROM exercise ORDER BY date DESC LIMIT 0, 1;
SQLEND;
$stmt = $db->prepare($sql);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$eid = $row['date'];

echo "<h4>Latest training input: ".  $eid . "</h4>";

?>
