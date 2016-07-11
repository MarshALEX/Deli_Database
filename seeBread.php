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
<title>Sandwich Database- Bread Table By Alex Marsh</title>
</head>
<body> 
<div>
    <table>
        <thead>
        <tr>
            <th>Bread table</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td> Bread Id</td>
                <td> Bread Name</td>
                <td> Vegan Bread?</td>
            </tr>
        </tbody>
        <?php
if(!($stmt = $mysqli->prepare("SELECT bread_tbl.bread_id, bread_tbl.name, bread_tbl.bread_vegan FROM bread_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($bread_id, $name, $bread_vegan)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $bread_id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $bread_vegan . "\n</td>\n</tr>";
}
$stmt->close();
?>
    </table>
</div>

</body>
</html>