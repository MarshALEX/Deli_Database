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
                <td> Sandwich Id</td>
                <td> Name</td>
                <td>Review (0-5)</td>
                <td>Toatsted?</td>
                <td>Bread</td>
                <td>Cheese</td>
                <td>Price</td>
            </tr>
        </tbody>
        <?php
if(!($stmt = $mysqli->prepare("SELECT s.sandwich_id, s.name, s.review, s.toasted, b.name, c.name, s.price FROM sandwich_tbl s INNER JOIN cheese_tbl c ON c.cheese_id = s.cid INNER JOIN bread_tbl b ON b.bread_id = s.bid"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($sandwich_id, $name, $review, $toasted, $bid, $cid, $price)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $sandwich_id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $review . "\n</td>\n<td>\n" . $toasted . "\n</td>\n<td>\n" . $bid . "\n</td>\n<td>\n" . $cid . "\n</td>\n<td>\n" . $price . "\n</td>\n</tr>\n";
}
$stmt->close();
?>
    </table>
</div>

</body>
</html>