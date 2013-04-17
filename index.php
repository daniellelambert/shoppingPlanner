<?php
session_start()
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
<?php
	include "db_connect.php";
	
	if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } ?>
		
	<meta charset="UTF-8">
	<title>Shopping Planner</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="background-green">
		background
	</div>
	<div class="page">
		<div class="home-page">
			<div class="sidebar">
				
				<a href="index.php" id="logo">Shopping <br/>Planner</a>
				<ul>
					<li class="selected home">
						<a href="index.php">Home</a>
					</li>
					<li class="about">
						<a href="browseRecipes.php">Browse Recipes</a>
					</li>
					<li class="projects">
						<a href="mealPlansPage.php">Meal Plan</a>
					</li>
					<li class="blog">
						<a href="addRecipes.html">Add Recipes</a>
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
				<div class="content-home">
					<div>
						<h3>Make healthy <span class="beauty">home-made</span> meals today with your <span class="function">Shoppping Planner!</span> Don't let <span class="works">time</span> go to waste.</h3>
						<p>
							Your shopping planner is here to save you time!  Just begin by adding all your recipes into the system.  Your planner will generate a seven day meal plan with recipes and a shopping list so you can plan your week accordingly.  Feel free to change the Meal Plan as you please!
						</p>
					</div>
					<div class="featured">
						<img src="images/yum.jpg" alt="">
					</div>
					<div>
						<ul>
							<li>
								<a href="mealPlan.html"><img src="images/bg-projects.jpg" alt=""></a>
								<h4><a href="mealPlansPage.php">Meal Plan</a></h4>
								<h3><a href="mealPlansPage.php">Create your own Meal Plan</a></h3>
								<p>
									
								</p>
								<a href="mealPlan.html"></a>
							</li>
							<li>
								<a href="addRecipes.html"><img src="images/bg-blog.jpg" alt=""></a>
								<h4><a href="addRecipes.html">Search</a></h4>
								<h3><a href="addRecipes.html">Search for Recipes</a></h3>
								<p>
									
								</p>
								<a href="addRecipes.html"></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="footer">
					<p>
						Last Updated March 27, 2013
					</p>
					<ul>
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="browseRecipes.php">Browse Recipes</a>
						</li>
						<li>
							<a href="mealPlansPage.php">Meal Plans</a>
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