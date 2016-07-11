<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","marshal-db","iYbxOtL1kBJLJIYq","marshal-db");

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}



if(!($stmt = $mysqli->prepare("INSERT INTO sandwich_tbl(name, review, toasted, bid, cid, price) VALUES (?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("siiiii",$_POST['name'],$_POST['review'],$_POST['toasted'],$_POST['bid'],$_POST['cid'],$_POST['price']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to sandwich_tbl.";
}
?>