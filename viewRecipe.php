<?php
 session_start();
 
 include "db_connect.php";
 		if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
 
 if(isSet($_GET['id'])) {
	$recipe_id = $_GET['id'];
  }
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Recipes - Shopping Planner</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"
    type="text/javascript"></script>
</head>
<body>
	<div id="background-lightgreen">
		background
	</div>
	<div class="page">
		<div class="blog-page">
			<div class="sidebar">
				<a href="index.php" id="logo">Shopping <br/>Planner</a>
				<ul>
					<li class="home">
						<a href="index.php">Home</a>
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
					<li class="about">
						<a href="logout.php">Logout</a>
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
                                <?php
								
									$query = "Select pic_location from recipe where recipe_id=$recipe_id";
									$result = mysqli_query($db,$query) or die("Error Querying Database");
									$row = mysqli_fetch_array($result);
									$filename = 'dishIMG/'.$row['pic_location'].'.jpg';
									
									if (file_exists($filename)){
                                		echo '<img src="'.$filename.'" alt="" width="490" height="340">';
									}
									else {
										echo '<img src="images/dinner2.png" alt="">';
									}
									
								?>
									
									<div class="section">
										<div>
										
                                        <?php	
 
	
										#$query = "Select recipe.*, ingredient.*, food.* From recipe INNER JOIN ingredient INNER JOIN food ON recipe.recipe_id=ingredient.recipe_id and ingredient.food_id=food.food_id WHERE recipe.recipe_id =$recipe_id";
										$query = "Select * from recipe where recipe_id=$recipe_id";
										$result = mysqli_query($db,$query) or die("Error Querying Database");
	
										if($row = mysqli_fetch_array($result)){
											#print_r ($row);
											echo '<h3>'.$row['recipe_name'].'</h3><br/>';
											echo "<h4>Cook Time:</h4>";
											echo $row['cook_time'].'<br/><br/>';
											echo "<h4>Description:</h4>";
											echo $row['description'].'<br/><br/>';

										}	
										
										#Get ingredients
										$ingredientQuery = "SELECT ingredient.*, food.* FROM ingredient INNER JOIN food on ingredient.food_id=food.food_id where ingredient.recipe_id=$recipe_id";
										$result2 = mysqli_query($db,$ingredientQuery) or die("Error Querying Database");
										echo "<h4>Ingredients:</h4>";
										while ($iRow = mysqli_fetch_array($result2)){
											#print_r ($iRow);
											echo $iRow['amount'].' '.$iRow['units'].' of '.$iRow['food_name'].'<br/>';
										}
										
										echo "<br/>";
										echo "<h4>Instructions:</h4>";
										echo $row['instructions'].'<br/>';
										echo "<form id='formID' action='modifyRecipe.php' method='POST'> <input type='hidden' name='id' value=".$recipe_id." /> <input type='submit' value='Modify This Recipe!' /> </form><br/>";
										echo "<form id='deleteform' onsubmit='deleteRecipe()' action='deleteRecipe.php'  method='POST'> <input type='hidden' name='id' value=".$recipe_id." /> <input type='submit' value='Delete This Recipe!' onsubmit='deleteRecipe()'/> </form>";
										
                                        
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
							<a href="index.php">Home</a>
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
</html><script type='text/javascript'>

    function deleteRecipe() {
	
        alert('That recipe was deleted.It tasted bad anyway.');
        
	}

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
var j = 1;
function AddIngredient(){
var content=document.getElementById('ingredientDiv');
var newBox=document.createElement('div');
newBox.setAttribute('id', 'ingredients'+j);
newBox.innerHTML = ("<table><tr><td><input type='text' style='width:100px;' value='Amount*' id='foodAmount' name='food["+j+"][Amt]'onblur='this.value=!this.value?'Amount *':this.value;' onfocus='this.select()' onclick='this.value='';'></td> <td><input type='text' value='Units*' style='width:100px;' id='Units' name='food["+j+"][Unit]'onblur='this.value=!this.value?'Units *':this.value;' onfocus='this.select()' onclick='this.value='';'></td><td><input type='text' style='width:100px;' value='Of*' id='food_Name' name='food["+j+"][Food_Name]' onblur='this.value=!this.value?'of *':this.value;' onfocus='this.select()' onclick='this.value='';'></td></tr></table>");
content.appendChild (newBox);
j++;
}

</script>