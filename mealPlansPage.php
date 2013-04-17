<?php
session_start();

	include "db_connect.php";
	include "helperFunctions.php";
			if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Meal Plan - Shopping Planner</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="background-lightyellow">
		background
	</div>
	<div class="page">
		<div class="project-page">
			<div class="sidebar">
				<a href="index.php" id="logo">Shopping <br/>Planner</a>
				<ul>
					<li class="home">
						<a href="index.php">Home</a>
					</li>
					<li class="about">
						<a href="browseRecipes.php">Browse Recipes</a>
					</li>
					<li class="selected projects">
						<a href="mealPlansPage.php">Meal Plan</a>
					</li>
					<li class="blog">
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
				<div class="content-project">
					<div>
						<h3>Meal Plan</h3>
					</div>
					<div class="navigation">
						
						</ul>
					</div>
					<div>
						<ul>
							<li>
							
	<a href="mealPlan.php"><h3>GENERATE RANDOM MEAL PLAN</h3></a>
	<a href="createNewMealPlan.php"><h3>CREATE NEW MEAL PLAN</h3></a>
	</br>
	
	<h4>Archived Meal Plans</h4>						
<?php						

	$query = "SELECT * FROM meal_plan";
	$result = mysqli_query($db, $query) OR DIE (mysqli_error($db));
	while (	$row = mysqli_fetch_array($result)){
	
		echo "<a href=\"viewOldMealPlan.php?id=".$row['meal_plan_id']."\" target=\"_blank\"> Meal Plan for the Week of: ".$row['week_start']."</br>";
	
	}

      
?>
							
							</li>
							<li>
								
							</li>
							<li>
								
							</li>
							<li>
							
							</li>
							<li>
								
							</li>
							<li>
								
							</li>
						</ul>
						<div class="paging">
							
							<span></span>
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
</html>