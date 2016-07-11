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
<title>Sandwich Database- Side Dish Table By Alex Marsh</title>
</head>
<body> 
<div>
    <table>
        <thead>
        <tr>
            <th>Side Dish Table</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td> Price </td>
                <td> Side Dish</td>
                <td>Sandwich</td>
            </tr>
        </tbody>
        <?php
if(!($stmt = $mysqli->prepare("SELECT sm.price, sd.name, s.name FROM set_menu_tbl sm INNER JOIN sandwich_tbl s ON s.sandwich_id = sm.sand_id INNER JOIN side_dish_tbl sd ON sd.sideDish_id = sm.side_id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($price, $side_name, $sand_name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $price . "\n</td>\n<td>\n" . $side_name . "\n</td>\n<td>\n" . $sand_name . "\n</td>\n</tr>\n";
}
$stmt->close();
?>
    </table>
</div>

</body>
</html>