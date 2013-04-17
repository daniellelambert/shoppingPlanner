<?php
session_start()
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Browse Recipes - Shopping Planner</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="background-yellow">
		background
	</div>
	<div class="page">
		<div class="about-page">
			<div class="sidebar">
				<a href="index.php" id="logo">Shopping <br/>Planner</a>
				<ul>
					<li class="home">
						<a href="index.php">Home</a>
					</li>
					<li class="selected about">
						<a href="browseRecipes.php">Browse Recipes</a>
					</li>
					<li class="projects">
						<a href="mealPlan.html">Meal Plan</a>
					</li>
					<li class="blog">
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
				<div class="content-about">
					<div>
						<h3>Browse Recipes - Sides</h3>
					</div>
					<div class="featured">
						<img src="images/dining-room.jpg" alt="">
					</div>
					<div>
						<div>
							<p class="dishes">
							<?php
		include "db_connect.php";
				if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
		
		$query = 'SELECT * FROM recipe WHERE side_dishes = -1';
		$result = mysqli_query($db, $query);
		echo '<table cellspacing="20"> <tr><td><h1>Name</h1></td> <td>cook time</td> <td>rating</td> <td>last cook</td></tr>';
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
	echo '<td><a href="viewRecipe.php?id='.$id.'"><h1>'.$name.' </a></h1></td><td>'.$cook_time.'</td><td>'.$rating.'</td><td>'.$last_cook.'</td>';
	
	echo '</tr>';

		}
	echo '</table>';
?>
								<br><br>
								<br><br>
								Ignore this stuff here, I will fix it and format it so it's prettier.  Enter a short description here about the dish.</p><a href="http://www.freewebsitetemplates.com/about/terms">Edit this dish</a> <img src="images/dinner3.png" alt="">
							<br><br>
						</div>
						<div class="sidebar">
							<div>
								<h3>Browse By</h3>
								<a href="browseRecipesEntrees.php">Entrees</a> <a href="browseRecipesSides.php">Side Dishes</a><a href="browseRecipesRatings.php">Ratings</a><a href="#">Favorites</a>
							</div>
							<div>
								<h3>Search</h3>
								<ul>
									
								<form method="post" form action="searchRecipe.php">
									<input type="text" name="search" value="" onblur="this.value=!this.value?'Search recipe here...':this.value;" onfocus="this.select()" onclick="this.value='';">
									<input type="submit" value="Search">
								</form>
									
									<li>
										
									</li>
									<li>
										
									</li>
								</ul>
								<ul>
									<li>
										
									</li>
									<li>
										
									</li>
									<li>
										
									</li>
								</ul>
							</div>
							
						</div>
					</div>
				</div>
				<div class="footer">
					<p>
						&#169; 2023 Origins Interior Architects
					</p>
					<ul>
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="browseRecipes.php">About</a>
						</li>
						<li>
							<a href="mealPlan.html">Projects</a>
						</li>
						<li>
							<a href="addRecipes.php">Add Recipe</a>
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