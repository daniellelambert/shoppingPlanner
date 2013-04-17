<?php
session_start();
if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php }
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
						<a href="mealPlansPage.php">Meal Plan</a>
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
							<h3>Add Recipes</h3>
							<div class="paging">
								
							</div>
							<ul>
								<li>
									<img src="images/dinner2.png" alt="">
									
									<div class="section">
										<div>
											
											<form id='formID' action='addRecipe.php' onsubmit='return validateForm()' method='POST'>
												<h4>Add Dish</h4>
												<input type="text" value="Recipe Name*" id='Dish_Name' name='Dish_Name' onblur="this.value=!this.value?'Recipe Name *':this.value;" onfocus="this.select()" onclick="this.value='';">
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
												<div id='mainDish' style="visibility:hidden" > How many side dishes should this be served with?<input type='number' name='sideDish'  value='-1'> </div>
												<br/><br/>
												<input type="submit" id="submit" value="Submit">
											</form>
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
							<a href="mealPlan.php">Meal Plan</a>
						</li>
						<li>
							<a href="mealPlansPage.php">Add Recipes</a>
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

function validateForm()
{
var x=document.forms["formID"]["Dish_Name"].value;
if (x==null || x=="" || x=="Recipe Name*")
  {
  alert("Recipe name must be filled out");
  return false;
  }
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