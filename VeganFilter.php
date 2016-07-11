<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","marshal-db","iYbxOtL1kBJLJIYq","marshal-db");

?>

<!DOCTYPE html PUBLIC>
<html>
<body>
<div>
	<table>
		<tr>
			<td>Set Menu</td>
		</tr>
		<tr>
			<td>Sandwich </td>
			<td>Side Dish</td>
			<td>Price</td>
		</tr>
<?php
  if($_POST['veganChoice'] == 1)
  {   
    if(!($stmt = $mysqli->prepare("SELECT sw.name, sd.name, sm.price FROM set_menu_tbl sm
INNER JOIN sandwich_tbl sw ON sw.sandwich_id = sm.sand_id
INNER JOIN side_dish_tbl sd ON sd.sideDish_id = sm.side_id
INNER JOIN cheese_tbl c ON c.cheese_id = sw.cid
INNER JOIN bread_tbl b ON b.bread_id = sw.bid
WHERE sd.side_vegan = 1 AND c.cheese_id = 1 AND b.bread_vegan = ? "))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['veganChoice']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($sandwich_name, $side_name, $price)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $sandwich_name . "\n</td>\n<td>\n" . $side_name . "\n</td>\n<td>\n" . $price . "\n</td>\n</tr>";
}
$stmt->close();

  }

  else
  {
      
    if(!($stmt = $mysqli->prepare("SELECT sw.name, sd.name, sm.price FROM set_menu_tbl sm
INNER JOIN sandwich_tbl sw ON sw.sandwich_id = sm.sand_id
INNER JOIN side_dish_tbl sd ON sd.sideDish_id = sm.side_id
INNER JOIN cheese_tbl c ON c.cheese_id = sw.cid
INNER JOIN bread_tbl b ON b.bread_id = sw.bid
WHERE sd.side_vegan = 0 OR c.cheese_id <> 1 OR b.bread_vegan = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['veganChoice']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($sandwich_name, $side_name, $price)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $sandwich_name . "\n</td>\n<td>\n" . $side_name . "\n</td>\n<td>\n" . $price . "\n</td>\n</tr>";
}
$stmt->close();
  }

?>
	</table>
</div>

</body>
</html>