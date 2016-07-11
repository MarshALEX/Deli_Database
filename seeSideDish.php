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
                <td> Side Id</td>
                <td>  Name</td>
                <td>Price</td>
                <td> Vegan Bread?</td>
            </tr>
        </tbody>
        <?php
if(!($stmt = $mysqli->prepare("SELECT side_dish_tbl.sideDish_id, side_dish_tbl.name, side_dish_tbl.price, side_dish_tbl.side_vegan FROM side_dish_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($sideDish_id, $name, $price, $side_vegan)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $sideDish_id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $price . "\n</td>\n<td>\n" . $side_vegan . "\n</td>\n</tr>\n";
}
$stmt->close();
?>
    </table>
</div>

</body>
</html>