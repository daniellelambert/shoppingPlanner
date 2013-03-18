<html>
<?php
		include "db_connect.php";
		
		$query = 'SELECT * FROM recipe';
		$result = mysqli_query($db, $query);
		echo '<table> <tr><td>name</td> <td>cook time</td> <td>rating</td> <td>last cook</td></tr>';
		while (	$row = mysqli_fetch_array($result)){
	#recipe order: id, name, description, instructions(directions), cook_time, rating, comments, last_cook_week, date_added, side_dishes, pic_location	
	echo '<tr>';
		$id = $row['recipe_id'];
		$name = $row['recipe_name'];
		$descrip = $row['description'];
		$instruct = $row['instructions'];
		$cook_time = $row['cook_time'];
		$rating = $row['rating'];
		$comments = $row['comments'];
		$last_cook = $row['last_cook_week'];
		$added = $row['date_added'];
		$side_dishes = $row['side_dishes'];
		$pic = $row['pic_location'];
	echo '<td><a href="viewRecipe.php?id='.$id.'">'.$name.' </a></td><td>'.$cook_time.'</td><td>'.$rating.'</td><td>'.$last_cook.'</td>';
	
	echo '</tr>';

		}
	echo '</table>';
?>

