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
							<h3></h3>
							<div class="paging">
								
							</div>
							<ul>
								<li>
									<img src="images/dinner2.png" alt="">
									
									<div class="section">
										<div>
										

										<?php
										
										#Still working on actually updating the recipe. 
											include "db_connect.php";
													if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
										#Getting values from form
										$recipe = $_POST;
										$rec_id = mysqli_real_escape_string($db, trim($recipe['id']));
										#string
										$recipe_name = mysqli_real_escape_string($db, trim($recipe['Dish_Name']));
										#string
										$directions = mysqli_real_escape_string($db, trim($recipe['direct']));
										#string
										$description =   mysqli_real_escape_string($db, trim($recipe['descript']));
										#time (maybe date time?
										$cook_time =  mysqli_real_escape_string($db, trim($recipe['cook_time']));
										#string
										$comment = mysqli_real_escape_string($db, trim($recipe['comments']));
										#number
										//$sides = mysqli_real_escape_string($db, trim($recipe['sideDish']));

										#Updating recipe with values from form
										$update_rec = "UPDATE recipe SET recipe_name='".$recipe_name."', description='".$description."', instructions='".$directions."', cook_time='".$cook_time."', comments='".$comment."' WHERE recipe_id = ".$rec_id;
										
										 mysqli_query($db, $update_rec) OR DIE (mysqli_error($db));
										
										
										 #Foreach loop to increment over stuff for food/ingredient
										foreach ($recipe['food'] as $k => $v){

										#check if updating ingredient
											if (isset($v['food_id'])){
												
												#print_r ($v);
												echo "<br/>";
												#if checkbox to delete == 'Yes', delete it
												if (isset($v['delCheck']) && $v['delCheck']=='on'){
													$delete_Query = "DELETE FROM ingredient where recipe_id =".$rec_id." and ".$v['food_id'];
													mysqli_query($db, $delete_Query) OR DIE (mysqli_error($db));
												}
												else{
													#Update ingredient and food with new info
													$update_ingred = "update ingredient set amount=".$v['Amt'].", units='".$v['Unit']."' where recipe_id=".$rec_id." && food_id=".$v['food_id'];
													$update_food = "update food set food_name='".$v['Food_Name']."' WHERE food_id=".$v['food_id'];
													mysqli_query($db, $update_ingred) OR DIE ("Here! ".$update_ingred);
													mysqli_query($db, $update_food) OR DIE ($update_food);
												}
											}
										else{
                                                                                    if (!(isset($v['delCheck'])) || $v['delCheck']!='on'){

												   #print_r ($v);
												
												#Adding new food. 
													$food_result = getFood($v['Food_Name'], $db);
												if ($food_result == null){
													
										#if it isn't in the db, add it.
											 $insert_food =  "INSERT INTO food VALUES (null, '".mysqli_real_escape_string($db, trim($v['Food_Name']))."', 'placeHolder')";
													 $result_insert_food =mysqli_query($db, $insert_food) OR DIE ("ERROR INSERTING FOOD".$insert_food);
												if ( $result_insert_food == false){
													echo "ERROR inserting food";
												}
																  #getting food again (for food_id)
																 $food_result = getFood($v['Food_Name'], $db);
										 
														}
										#Adding ingredient
										
										$amt = mysqli_real_escape_string($db, trim($v['Amt']));
										$unit = mysqli_real_escape_string($db, trim($v['Unit']));
										$insert_ingredient = "INSERT INTO ingredient VALUES ((select MAX(food.food_id) from food), ".$rec_id.", '$amt', '$unit')";
										$result_insert_ingredient =mysqli_query($db, $insert_ingredient) OR DIE (mysqli_error($db));
                                                                                                       }}
												
												}


										#else (meaning insert need ingredient to the DB
												#check DB for Food name
													#if it is
														#insert into ingredient values ($recipe.name, food_id from DB check, amt, units);
													#else
														#insert into food values (null, food[i][food_name], 'placehold')
														#insert into ingredient values ($recipe.name, (select MAX(food.food_id) from food), amt, units);
														
									#redirect back to recipe page
									echo "<p>The recipe has been modified. <a href=\"viewRecipe.php?id=".$rec_id."\">Click Here</a> to return back to the recipe page.</p>";
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