<?php
 session_start();
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Recipes - Shopping Planner</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="background-lightgreen">
		background
	</div>
	<div class="page">
		<div class="blog-page">
			<div class="sidebar">
				<a href="index.html" id="logo">Shopping <br/>Planner</a>
				<ul>
					<li class="home">
						<a href="index.html">Home</a>
					</li>
					<li class="about">
						<a href="browseRecipes.php">Browse Recipes</a>
					</li>
					<li class="projects">
						<a href="mealPlan.html">Meal Plan</a>
					</li>
					<li class="selected blog">
						<a href="addRecipes.php">Add Recipes</a>
					</li>
					<li class="contact">
						<a href="searchRecipe.php">Search</a>
					</li>
				</ul>
				
			</div>
			<div class="body">
				<div class="content-blog-single">
					<div>
						<div>
							<h3></h3>
							<div class="paging">
								
							</div>
							<ul>
								<li>
									<img src="images/dinner2.png" alt="">
									
									<div class="section">
										<div>
										
                                        <?php	
										
										include "db_connect.php";
												if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
									  #Wasn't sure where to define this so it works with javascript later. Increment is used in the food/ingredients array, to keep the amount, units, and name seperated.
									$increment = 0;
									  if(isSet($_POST['id'])) {
										$recipe_id = $_POST['id'];
										}
										
									#	$query = "Select recipe.*, ingredient.*, food.* From recipe INNER JOIN ingredient INNER JOIN food ON recipe.recipe_id=ingredient.recipe_id and ingredient.food_id=food.food_id WHERE recipe.recipe_id =$recipe_id";
										$query = "Select * from recipe where recipe_id=".$recipe_id;
										$result = mysqli_query($db,$query) or die("Error Querying Database");
										
										if($row = mysqli_fetch_array($result)){
										echo "<form id='formID' action='modifyRecipeConfirm.php' method='POST'>";
									#	print_r ($row);
											echo 'Name: <input type="text" name="Dish_Name" value="'.$row['recipe_name'].'" /><br/>';
										echo 'Cook Time: <input type="text" name="cook_time" value="'.$row['cook_time'].'" /><br/><br/>';
										echo "Description: <br/> <textarea form='formID' name='descript'>".$row['description']." </textarea> <br/><br/>";
									
										}	
										#Get ingredients
										
										$ingredientQuery = "SELECT ingredient.*, food.* FROM ingredient INNER JOIN food on ingredient.food_id=food.food_id where ingredient.recipe_id=$recipe_id";
										$result2 = mysqli_query($db,$ingredientQuery) or die("Error Querying Database");
									echo "<div id='ingredientDiv'> ";
									$increment = 0;
										while ($iRow = mysqli_fetch_array($result2)){
											echo "<br/> <br/>";
									
									#		print_r ($iRow);
									echo "Remove from Recipe: <input type='checkbox' id='foodCheck' name='food[$increment][delCheck]' />";
									 echo "<input type='hidden' name='food[$increment][food_id]' value='".$iRow['food_id']."'/> Amount: <input type='text' id='foodAmount' name='food[$increment][Amt]' value='".$iRow['amount']."' />  Units: <input type='text' id='Units' name='food[$increment][Unit]' value='".$iRow['units']."' />  of: <input type='text' id='food_Name' name='food[$increment][Food_Name]' value='".$iRow['food_name']."' /> <br/>";
		
									 $increment++;
										}
										
										echo "</div>";
										echo "<input type='button' value='More Ingredients' onClick='AddIngredient()'> <br/>";
										echo "Directions: <br/> <textarea form='formID' name='direct'>".$row['instructions']." </textarea> <br/><br/>";
										echo "Comments: <br/> <textarea form='formID' name='comments'>".$row['comments']." </textarea> <br/><br/>";
										echo "<input type='hidden' name='id' value='".$recipe_id."'/>";
										echo "<input type='submit' value='Modify!'/>";
										echo "</form>";
										
										?>
                                        
                                       
                                            
                                            
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="sidebar">
							<div>
							
							</div>
							
							<div>
								
								<ul>
									
								</ul>
								<ul>
									
								</ul>
							</div>
							
						</div>
					</div>
				</div>
				<div class="footer">
					<p>
						
					</p>
					<ul>
						<li>
							<a href="index.html">Home</a>
						</li>
						<li>
							<a href="browseRecipes.php">Browse Recipes</a>
						</li>
						<li>
							<a href="mealPlan.html">Meal Plan</a>
						</li>
						<li>
							<a href="addRecipes.php">Add Recipes</a>
						</li>
						<li>
							<a href="searchRecipe.php">Search Recipe</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type='text/javascript'>
/*var mainCheck = document.getElementById('mainCheck');
var dishChecker = document.createElement('div');
dishChecker = setAttribute('id', 'dish_checker');

dishChecker.innerHTML = ("");
mainCheck.appendChild (dishChecker);
*/
function mainDishCheck(){
if (document.getElementById('mainDishCBox').checked){
document.getElementById('mainDish').style.visibility = 'visible';
}
else { 
document.getElementById('mainDish').style.visibility = 'hidden';
}
}
var j = <?php echo $increment ?>;
function AddIngredient(){
var content=document.getElementById('ingredientDiv');
var newBox=document.createElement('div');
newBox.setAttribute('id', 'ingredients'+j);
newBox.innerHTML = ("Remove from Recipe: <input type='checkbox' id='foodCheck' name='food["+j+"][delCheck]' />Amount: <input type='text' id='foodAmount' name='food["+j+"][Amt]' />  Units: <input type='text' id='Units' name='food["+j+"][Unit]' />  of: <input type='text' id='food_Name' name='food["+j+"][Food_Name]' /> <br/>  ");
content.appendChild (newBox);
j++;


}
</script>