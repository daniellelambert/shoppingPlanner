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
						<a href="mealPlansPage.html">Meal Plan</a>
					</li>
					<li class="selected blog">
						<a href="addRecipes.php">Add Recipes</a>
					</li>
					<li class="contact">
						<a href="searchRecipe.php">Search Recipe</a>
					</li>
				</ul>
				<div class="connect">
					<a href="http://freewebsitetemplates.com/go/facebook/" id="fb">facebook</a> <a href="http://freewebsitetemplates.com/go/twitter/" id="twitter">twitter</a> <a href="http://freewebsitetemplates.com/go/googleplus/" id="googleplus">google+</a> <a href="http://freewebsitetemplates.com/go/youtube/" id="youtube">youtube</a>
				</div>
			</div>
			<div class="body">
				<div class="content-blog-single">
					<div>
						<div>
							<h3>Add Recipes</h3>
							<div class="paging">
								
							</div>
							<ul>
								<li>
									<img src="images/dinner2.png" alt="">
									
									<div class="section">
										<div>
											<!--
											<form id='formID' action='addRecipe.php' method='POST'>
												<h4>Add Dish</h4>
												<input type="text" value="Recipe Name*" name='Dish_Name' onblur="this.value=!this.value?'Title *':this.value;" onfocus="this.select()" onclick="this.value='';">
											<div id='ingredientDiv'> 
												<table><tr><td><input type="text" style="width:100px;" value="Amount*" id='foodAmount' name='food[0][Amt]' onblur="this.value=!this.value?'Amount *':this.value;" onfocus="this.select()" onclick="this.value='';"></td>
												<td><input type="text" value="Units*" style="width:100px;" id='Units' name='food[0][Unit]'onblur="this.value=!this.value?'Units *':this.value;" onfocus="this.select()" onclick="this.value='';"></td>
												<td><input type="text" style="width:100px;" value="Of*" id='food_Name' name='food[0][Food_Name]' onblur="this.value=!this.value?'of *':this.value;" onfocus="this.select()" onclick="this.value='';"></td></tr>
												</table>
												</div>
												
												<br/>
												<input type='button' value='More Ingredients' onClick='AddIngredient()'> <br/>
												<textarea form='formID' name='directions'id="comment" cols="30" rows="10" onblur="this.value=!this.value?'Directions':this.value;" onfocus="this.select()" onclick="this.value='';">Directions</textarea>
												<textarea name='description' form='formID'id="comment" cols="30" rows="10" onblur="this.value=!this.value?'Description':this.value;" onfocus="this.select()" onclick="this.value='';">Description</textarea>
												Cook Time: <input type='text' style="width:75px;" name='cook_time'/><br/>
												<input type="text" value="Comments*" name='comments'onblur="this.value=!this.value?'Comments *':this.value;" onfocus="this.select()" onclick="this.value='';">
												Main Dish? <input type="checkbox" id='mainDishCBox' onClick="mainDishCheck()">
												<br/>
												<div id='mainDish' style="width:50px;" style="visibility:hidden" > <input type='number' name='sideDish' value=-1> </div>
												<br/><br/>
												<input type="submit" id="submit" value="Submit">
											</form>
											-->
											<?php
session_start();

	include "db_connect.php";
	
$recipe = $_POST;
 

#string
$recipe_name = (isSet($recipe['Dish_Name']) ? mysqli_real_escape_string($db, trim($recipe['Dish_Name'])) : 'placeHolder');
#string
$directions = (isSet($recipe['directions']) ? mysqli_real_escape_string($db, trim($recipe['directions'])) : 'placeHolder');
#string
$description =  (isSet($recipe['description']) ? mysqli_real_escape_string($db, trim($recipe['description'])) : 'placeHolder');
#time (maybe date time?
$cook_time = (isSet($recipe['cook_time']) ? mysqli_real_escape_string($db, trim($recipe['cook_time'])) : '00:00:00');
#string
$comment = (isSet($recipe['comments']) ? mysqli_real_escape_string($db, trim($recipe['comments'])) : 'placeHolder');
#number
$sides = (isSet($recipe['sideDish']) ? mysqli_real_escape_string($db, trim($recipe['sideDish'])) : -1);

echo "<h4>".$recipe['Dish_Name']."</h4><br/>";
echo "directions: ".$recipe['directions']."<br/>";
#inserting recipe into database
	#check if the name is in use
	$dish_name_check = "SELECT * FROM recipe WHERE recipe_name='$recipe_name'"; 
	$rec_result = mysqli_query($db, $dish_name_check);
	$r_row = mysqli_fetch_array($rec_result);
	if ($r_row != null){
	#return error if it is (not completed, just dieing if it's already in DB)
	die ("Recipe already exists in database!");
	}
	#recipe order: id, name, description, instructions(directions), cook_time, rating, comments, last_cook_week, date_added, side_dishes, pic_location
			#Add it to database, remember to add dummy values for any slots not filled in
	$insert_recipe =  "INSERT INTO recipe VALUES (null, '".$recipe_name."', '".$description."','".$directions."', '".$cook_time."', 1, '".$comment."', '0000-00-00', CURDATE(),".$sides.", 'placeholder')";
	 $result_insert_food =mysqli_query($db, $insert_recipe) OR DIE (mysqli_error($db));




#Inserting ingredients

#Start with adding food
foreach ($recipe['food'] as $k => $v){
echo "here! <br/>";
print_r ($v);
echo "<br/> <br/>";

#check if food is in DB,
$food_result = getFood($v['Food_Name'], $db);
if ($food_result == null){
#if it isn't in the db, add it.
 echo "<h3>Inserting food into db!</h3>  ".$v['Food_Name']."<br/>";
 $insert_food =  "INSERT INTO food VALUES (null, '".mysqli_real_escape_string($db, trim($v['Food_Name']))."', 'placeHolder')";
 $result_insert_food =mysqli_query($db, $insert_food) OR DIE ("ERROR INSERTING FOOD".$insert_food);
 if ( $result_insert_food == false){
	echo "ERROR inserting food";
 }
 #getting food again (for food_id)
 $food_result = getFood($v['Food_Name'], $db);
 
 }
#Adding ingredient
 echo $food_result['food_id']."    I'm here!";
 $amt = mysqli_real_escape_string($db, trim($v['Amt']));
 $unit = mysqli_real_escape_string($db, trim($v['Unit']));
 $insert_ingredient = "INSERT INTO ingredient VALUES ((select MAX(food.food_id) from food), (select MAX(recipe.recipe_id) from recipe), '$amt', '$unit')";
	$result_insert_ingredient =mysqli_query($db, $insert_ingredient) OR DIE (mysqli_error($db));
	$id = $food_result['recipe_id'];
	echo '<meta http-equiv = "REFRESH" content="0;url="viewRecipe.php?id='.$id.'">';
 }
	
	
?>	
	<p><a href=\"index.html\">Continue</a></p>";	

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
							<a href="mealPlansPage.php">Meal Plan</a>
						</li>
						<li>
							<a href="addRecipes.html">Add Recipes</a>
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

<?php 
function getFood ($food_name, $db){
$query = 'Select * from food where food_name="'.$food_name.'"'; 

$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result);
	
return ($row);

}

?>
<script type='text/javascript'>

function validateForm()
{
var x=document.forms["myForm"]["fname"].value;
if (x==null || x=="")
  {
  alert("First name must be filled out");
  return false;
  }
}
</script>
