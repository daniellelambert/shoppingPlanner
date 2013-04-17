<?php
session_start();

	include "db_connect.php";
	include "helperFunctions.php";
			if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
	
	if(isSet($_GET['id'])) {
		$plan_id = $_GET['id'];
 	 }
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
				<a href="index.html" id="logo">Shopping <br/>Planner</a>
				<ul>
					<li class="home">
						<a href="index.html">Home</a>
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
						<a href="searchRecipe.php">Search Recipe</a>
					</li>
				</ul>
				<div class="connect">
					<a href="http://freewebsitetemplates.com/go/facebook/" id="fb">facebook</a> <a href="http://freewebsitetemplates.com/go/twitter/" id="twitter">twitter</a> <a href="http://freewebsitetemplates.com/go/googleplus/" id="googleplus">google+</a> <a href="http://freewebsitetemplates.com/go/youtube/" id="youtube">youtube</a>
				</div>
			</div>
			<div class="body">
				<div class="content-project">
					<div>
						<h3>Meal Plan</h3>
					</div>
					<div class="navigation">
						<span>View:</span>
						<ul>
							<li class="selected">
								<a href="#">All</a>
							</li>
							<li>
								<a href="mealPlansPage.php">Meal Plans</a>
							</li>
							<li>
								<a href="shoppingListPDF.php" target=\"_blank\">Shopping List</a>
							</li>
							<li>
								<a href="recipeListPDF.php" target=\"_blank\">Recipes</a>
							</li>
							<li>
								
							</li>
							<li>
								
							</li>
						</ul>
					</div>
					<div>
						<ul>
							<li>
<?php						
        
        
        //DISPLAY MEAL PLAN
  
    	$mealPlan = getMealPlan ($plan_id, $db);
    	#print_r($mealPlan);
    	$_SESSION['mealPlanArray'] = $mealPlan;
    	
    	echo "<h1><b>Meal Plan For The Week Of ".$mealPlan['week_start']."</b></br></br></h1>";
    	
    	foreach ($mealPlan['meals'] as $meal){
    	
    		echo "<h2><b>".$meal['cook_date']."</b></br></h2>";
    		
    		$first = true;
    		foreach($meal['dishes'] as $dish){
    		
    			if ($first == true){
    				echo "<b><font size=\"4\">Main Entree:</font></br></b>";
    				echo "<font size=\"4\"><a href=\"viewRecipe.php?id=".$dish['recipe_id']."\" target=\"_blank\">".$dish['recipe_name']."</br></a></font>";
    				echo "</br>";
    			}
    			else {
    				echo "<b>Side Dish:</b> <a href=\"viewRecipe.php?id=".$dish['recipe_id']."\" target=\"_blank\">".$dish['recipe_name']."</br></a>";
    			}
    			$first = false;
    		
    		}
    		
    		echo "</br></br>";
    	
    	
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
							<ul>
								<li class="selected">
									<a href="#">1</a>
								</li>
								<li>
									<a href="#">2</a>
								</li>
								<li>
									<a href="#">></a>
								</li>
							</ul>
							<span>Page 1 of 2</span>
						</div>
					</div>
				</div>
				<div class="footer">
					<p>
						&#169; 2023 Origins Interior Architects
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