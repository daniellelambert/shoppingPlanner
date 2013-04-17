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
					<li class="blog">
						<a href="addRecipes.php">Add Recipes</a>
					</li>
					<li class="selected contact">
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
							<h3>Search Recipes</h3>
							<div class="paging">
								
							</div>
							<ul>
								<li>
									<img src="images/recipe-collage.jpg" width="490" alt="">
									
									<div class="section">
										<div>
											<?php
											if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
											
											if (isset($_POST['search'])){
											
											include "db_connect.php";
													
											
											
											
											$searchTerm = mysql_real_escape_string($_POST['search']);
											
											$query = 'SELECT * FROM recipe WHERE recipe_name LIKE \'%'.  $searchTerm . '%\'';
											#echo $query;
											$result = mysqli_query($db, $query);
											echo '<table cellspacing="20"> <tr><td><h2>Name</h2></td> <td>cook time</td> <td>rating</td> <td>last cook</td></tr>';
											
											while ($row = mysqli_fetch_array($result)){
												
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
												
												echo '<td><a href="viewRecipe.php?id='.$id.'"><h1>'.$name.' </a></h1></td><td>'.$cook_time.'</td><td>'.$rating.'</td><td>'.$last_cook.'</td>';
												
												echo '</tr>';
											}
											
											echo '</table>';
                                            
                                          	
											}//end if
                                            
                                            ?>
                                            
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="sidebar">
							<div>
								<h3>Search Recipe</h3>
								<form method="post" form action="searchRecipe.php">
									<input type="text" name="search" value="Search recipe here..." onblur="this.value=!this.value?'Search recipe here...':this.value;" onfocus="this.select()" onclick="this.value='';">
									<input type="submit" value="">
								</form>
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
							<a href="mealPlansPage.php">Meal Plan</a>
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