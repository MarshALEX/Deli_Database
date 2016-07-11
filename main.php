<?php
//turn on error reporting
ini_set('display_errors', 'On');
//connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","marshal-db","iYbxOtL1kBJLJIYq","marshal-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>



<!DOCTYPE html PUBLIC >
<!--- Alex Marsh, CS340, Sandwich Database--->
<html>
<head>
<meta charset="UTF-8">
<title>Sandwich Database By Alex Marsh</title>
</head>
<body>
    <h1>Welcome to the Sandwich Shop Database!</h1>
    <div>
    <form method="post" action="seeBread.php">
    <p><input type="submit" name="seeBreadTable" value="Display Bread Table" /></p>
    </form>
    </div>
    
    <div>
    <form method="post" action="seeCheese.php">
    <p><input type="submit" name="seeCheeseTable" value="Display Cheese Table" /></p>
    </form>
    </div>
    
    <div>
    <form method="post" action="seeSideDish.php">
    <p><input type="submit" name="seeSideDishTable" value="Display Side Dish Table" /></p>
    </form>
    </div>
    
    <div>
    <form method="post" action="seeSandwich.php">
    <p><input type="submit" name="seeSandwichTable" value="Display Sandwich Table" /></p>
    </form>
    </div>
    
    <div>
    <form method="post" action="seeSetMenu.php">
    <p><input type="submit" name="seeSetMenuTable" value="Display Set Menu Table" /></p>
    </form>
    </div>
    
    
    
    <div>
    <table>
        <thead>
        <tr>
            <th>Side Dish table</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td> Side Id</td>
                <td> Name</td>
                <td>Price</td>
                <td>Vegan?</td>
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
    
    <div>
    <table>
        <thead>
        <tr>
            <th>Sandwich table</th>
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
    
    
      <div>
    <table>
        <thead>
        <tr>
            <th>Set Menu table</th>
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
    
    
    <div>
     <form method="post" action="addBread.php">
        <fieldset>
         <legend>Bread</legend>
         <p>Bread Name:<input type="text" name="name"/></p>
            <p>Is the bread vegan?</p>
            <select name="bread_vegan">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <p><input type="submit" name="addBread" value="Add Bread" /></p>
        </fieldset> 
     </form>
    </div>
    
    <div>
     <form method="post" action="addCheese.php">
        <fieldset>
         <legend>Cheese</legend>
         <p>Cheese Name:<input type="text" name="name"/></p>
        <p><input type="submit" name="addCheese" value="Add Cheese" /></p>    
        </fieldset>
         
     </form>
    </div>
    
    <div>
     <form method="post" action="addSandwich.php">
        <fieldset>
         <legend>Sandwich</legend>
         <p>Sandwich Name:<input type="text" name="name"/></p>
          <p>0-5 Star Review:<input type="text" name="review"/></p>
          <p>Is the sandwich toasted?</p>
            <select name="toasted">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>   
           <p>Bread:</p>
            <select name="bid">

<?php
if(!($stmt = $mysqli->prepare("SELECT bread_id, name FROM bread_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($bread_id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $bread_id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
           
            </select> 
            <p>Cheese:</p>
            <select name="cid">
  <?php
if(!($stmt = $mysqli->prepare("SELECT cheese_id, name FROM cheese_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($cheese_id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $cheese_id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>                   
            </select>
        <p>Price:<input type="text" name="price"/></p> 
            <p><input type="submit" name="addSandwich" value="Add Sandwich" /></p>
        </fieldset>
     
     </form>
    </div>
    
    
    
    
    <div>
    <!--CHANGE THIS LATER-->
    <form method="post" action="addSideDish.php">
    <fieldset> 
        <legend>Side Dish</legend>
        <p>Name: <input type="text" name="name"/></p>
        <p>Price: <input type="text" name="price"/></p>
        <p>Is this side vegan?</p>
        <select name="side_vegan">
                <option value="0">No</option>
                <option value="1">Yes</option>
        </select>  
   <p><input type="submit" name="addSideDish" value="Add Side Dish" /></p>
    </fieldset>
    
    </form>
    </div>
    
    <div>
        
        
    <!--CHANGE THIS LATER-->
    <form method="post" action="addSetMenu.php">
    <fieldset> 
        <legend>Set Menu</legend>
        <p>Price: <input type="text" name="price"/></p>
        
        <p>Sandwich: </p>
        <select name="sand_id">
  <?php
if(!($stmt = $mysqli->prepare("SELECT sandwich_id, name FROM sandwich_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($sandwich_id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $sandwich_id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>                   
            </select>
        
        <p>Side: </p>
        <select name="side_id">
  <?php
if(!($stmt = $mysqli->prepare("SELECT sideDish_id, name FROM side_dish_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($sideDish_id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $sideDish_id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>                   
            </select>
    <p><input type="submit" name="addSetMenu" value="Add Set Menu" /></p>  
    </fieldset>
    </form>
    </div>
    
<div>
    <form method="post" action="VeganFilter.php">
       <fieldset> 
        <legend>Filter Set Menu By Vegan Status</legend>   
        <p>Would you like to see the vegan or non vegan set menu options?</p>
        <select name="veganChoice">
            <option value="1">Vegan</option>
            <option value="0">Not Vegan</option>
        </select>
           <p><input type="submit" value="Run Vegan Filter" /></p>
      </fieldset>
    
    </form>
</div>

<div>
    <form method="post" action="deleteSetMenu.php">
    <fieldset>
        <legend>Delete a Set Menu</legend>
        <p>Please select the side dish and sandwich set you wish to delete:</p>
        <select name="sideDish_id">
        <?php
        if(!($stmt = $mysqli->prepare("SELECT sideDish_id, name FROM side_dish_tbl"))){
        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($sideDish_id, $name)){
        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
        echo '<option value=" '. $sideDish_id . ' "> ' . $name . '</option>\n';
        }
        $stmt->close();
        ?>   
        </select>
        
        
        
        <select name="sand_id">
        <?php
        if(!($stmt = $mysqli->prepare("SELECT sandwich_id, name FROM sandwich_tbl"))){
        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($sandwich_id, $name)){
        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
        echo '<option value=" '. $sandwich_id . ' "> ' . $name . '</option>\n';
        }
        $stmt->close();
        ?>                   
            </select>
        <p><input type="submit" value="Delete Set Menu"></p>   
    </fieldset>
    
    </form>
</div>  
    
<div>
<form method="post" action="updateSideDish.php">
<fieldset>
<legend>Update Side Dish Price</legend>  
    <p>Please select the side dish you would like to update:</p>
    <select name="sideDish_id">
        <?php
        if(!($stmt = $mysqli->prepare("SELECT sideDish_id, name FROM side_dish_tbl"))){
        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
        }

        if(!$stmt->execute()){
        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        if(!$stmt->bind_result($sideDish_id, $name)){
        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }
        while($stmt->fetch()){
        echo '<option value=" '. $sideDish_id . ' "> ' . $name . '</option>\n';
        }
        $stmt->close();
        ?>   
        </select>
       <p>New Price: <input type="text" name="newPrice"/></p>
    <p><input type="submit" value="Update Side Dish Price"></p>

</fieldset>
</form>
</div>
    
</body>
</html>