<?php
#layout still in the works
  session_start();
  echo "<html>";
  echo "<body>";
  include "db_connect.php";

  if(isSet($_GET['id'])) {
	$recipe_id = $_GET['id'];
	}
	
#	$query = "Select recipe.*, ingredient.*, food.* From recipe INNER JOIN ingredient INNER JOIN food ON recipe.recipe_id=ingredient.recipe_id and ingredient.food_id=food.food_id WHERE recipe.recipe_id =$recipe_id";
	$query = "Select * from recipe where recipe_id=$recipe_id";
	$result = mysqli_query($db,$query) or die("Error Querying Database");
	
	if($row = mysqli_fetch_array($result)){
#	print_r ($row);
		echo 'Name: '.$row['recipe_name'].'<br/>';
	echo 'Cook Time: '.$row['cook_time'].'<br/><br/>';
	echo $row['description'].'<br/><br/>';

	}	
	#Get ingredients
	$ingredientQuery = "SELECT ingredient.*, food.* FROM ingredient INNER JOIN food on ingredient.food_id=food.food_id where ingredient.recipe_id=$recipe_id";
	$result2 = mysqli_query($db,$ingredientQuery) or die("Error Querying Database");
	while ($iRow = mysqli_fetch_array($result2)){
		echo "<br/> <br/>";

#		print_r ($iRow);
		echo $iRow['amount'].' '.$iRow['units'].' of '.$iRow['food_name'].'<br/>';
	}
	
		echo $row['instructions'].'<br/>';
		echo "<form id='formID' action='modifyRecipe.php' method='POST'> <input type='hidden' name='id' value=".$recipe_id." /> <input type='submit' value='Modify This Recipe!' /> </form><br/>";
		echo "<form id='formID' action='deleteRecipe.php' method='POST'> <input type='hidden' name='id' value=".$recipe_id." /> <input type='submit' value='Delete This Recipe!' /> </form>";
	?>

	</body>
	</html>