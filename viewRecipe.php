<html>
<body>
<?php
#layout still in the works
  session_start();
  include "db_connect.php";

  if(isSet($_GET['id'])) {
	$recipe_id = $_GET['id'];
	}
	
	$query = "Select recipe.*, ingredient.*, food.* From recipe INNER JOIN ingredient INNER JOIN food ON recipe.recipe_id=ingredient.recipe_id and ingredient.food_id=food.food_id WHERE recipe.recipe_id =$recipe_id";
	$result = mysqli_query($db,$query) or die("Error Querying Database");
	
	if($row = mysqli_fetch_array($result)){
	print_r ($row);

	}	
	?>
	
	</body>
	</html>