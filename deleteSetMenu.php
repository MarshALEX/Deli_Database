<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","marshal-db","iYbxOtL1kBJLJIYq","marshal-db");

if( $_POST['sideDish_id'] == 9)
    echo "We have a 9";
if( $_POST['sand_id'] == 7 )
    echo "we have a 7";

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	


if(!($stmt = $mysqli->prepare("DELETE FROM set_menu_tbl
WHERE side_id = ? AND sand_id = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}


if(!($stmt->bind_param("ii",$_POST['sideDish_id'],$_POST['sand_id']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " rows from set_menu_tbl.";
}
?>