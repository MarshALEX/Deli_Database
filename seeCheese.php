<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new  mysqli("oniddb.cws.oregonstate.edu","marshal-db","iYbxOtL1kBJLJIYq","marshal-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>
<!DOCTYPE html PUBLIC>
<html> 
<head>
<meta charset="UTF-8">
<title>Sandwich Database- Cheese Table By Alex Marsh</title>
</head>
<body> 
<div>
    <table>
        <thead>
        <tr>
            <th>Cheese table</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td> Cheese Id</td>
                <td> Name</td>
            </tr>
        </tbody>
        <?php
if(!($stmt = $mysqli->prepare("SELECT cheese_tbl.cheese_id, cheese_tbl.name FROM cheese_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($cheese_id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $cheese_id . "\n</td>\n<td>\n" . $name . "\n</td>\n</tr>\n";
}
$stmt->close();
?>
    </table>
</div>

</body>
</html>