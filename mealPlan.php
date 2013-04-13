<?php
	include "db_connect.php";
	include "helperFunctions.php";
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
						<a href="mealPlan.php">Meal Plan</a>
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
								<a href="#">Meal Plan</a>
							</li>
							<li>
								<a href="#">Shopping List</a>
							</li>
							<li>
								<a href="#">Recipes</a>
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

    #echo "1<br/>";
#generate main dish
        $meals = array();
        $mainDish = array();
        $mainDish = generateMainDishes($db);
     #generate side dishes
        $i = 0;
        $sides = array();
        $ids = array();
            #echo "2<br/>";

            
            #Generates sides for each main dish. All sides choosen are unique for that week
    
        foreach ($mainDish as $main){
               $sides[$i] = generateSideDishes($db, $main['side_dishes'], $ids);
      #adding the side dish ids, to make sure recipes aren't reused
               
               foreach ($sides[$i] as $s){
                   array_push($ids, $s['recipe_id']);           
               }
               #echo "<br/> main dish ----";
               #print_r ($main);
               #echo "<br/><br/>";
               
               foreach ($sides[$i] as $s){
                  #echo "SIDE -- ";
                   #print_r ($s);
                  #echo"<br/><br/>";
               }
               #echo "<br/><br/><br/><br/>";
               
               $i++;
        }        
       
      
       
        $j = 0;
        $mealsID = array();
        #This for loop puts the meals together.
        #1.create/insert a new meal 
        #2. store the id from the just inserted meal in $mealsID[$j]
        #3. connect the meal and recipes
        for ($j = 0; $j < 7; $j++){
            #insert meal
        $insert_meal =  "INSERT INTO meal VALUES (null, DATE_ADD(CURDATE(),INTERVAL ".$j." DAY))";
        $result_insert_meal =mysqli_query($db, $insert_meal) OR DIE (mysqli_error($db));
   
                #store ID SELECT (MAX ID) FROM MEAL        
        $meal_id_select = "SELECT MAX(meal.meal_id) from meal";
         $result_meal_id = mysqli_query($db, $meal_id_select);
         $mealsID[$j] = mysqli_fetch_array($result_meal_id);
         
         #inserting main dish
         $dish_insert = "INSERT INTO dish VALUES (".$mainDish[$j][0].", ".$mealsID[$j][0].")";
         $result_insert_dish =mysqli_query($db, $dish_insert) OR DIE (mysqli_error($db));
       
         #inserting sides
         foreach ($sides[$j] as $rid){
     
             $dish_insert = "INSERT INTO dish VALUES (".$rid[0].", ".$mealsID[$j][0].")";
             $result_insert_dish =mysqli_query($db, $dish_insert) OR DIE (mysqli_error($db));

         }
        } 
         #insert/create meal plan
         $insertPlan = "INSERT INTO meal_plan VALUES (null, CURDATE(), 'placehodler')"; 
         $result_insert_plan =mysqli_query($db, $insertPlan) OR DIE (mysqli_error($db));
         
         
  
         #connecting the meal plan to the meal
             foreach ($mealsID as $mid){
                 #echo "13<br/>";
             //print_r($mid);
             $m_insert = "INSERT INTO meal_connector VALUES (".$mid[0].",(select MAX(meal_plan.meal_plan_id) from meal_plan))";
             $result_insert_dish =mysqli_query($db, $m_insert)OR DIE (mysqli_error($db));
             #echo "14<br/>";
             
         } 
        
        
        
        
        //DISPLAY MEAL PLAN
        $queryId = "select MAX(meal_plan.meal_plan_id) as meal_id from meal_plan";
        $result = mysqli_query($db, $queryId) OR DIE (mysqli_error($db));
        $row = mysqli_fetch_array($result);
        $mealId = $row['meal_id'];
  
    	$mealPlan = getMealPlan ($mealId, $db);
    	#print_r($mealPlan);
    	
    	echo "<b>Meal Plan For The Week Of ".$mealPlan['week_start']."</b></br></br>";
    	
    	foreach ($mealPlan['meals'] as $meal){
    	
    		echo "<b>".$meal['cook_date']."</b></br>";
    	
    		foreach($meal['dishes'] as $dish){
    		
    			echo "Dish Name: ".$dish['recipe_name']."</br>";
    		
    		
    		}
    		
    		echo "</br></br>";
    	
    	
    	}
    	
    
        
        
        
   
                        function generateMainDishes ($db){
                        $main = array();
                        $i =0;
                         $query = "SELECT DISTINCT `recipe_id`, `side_dishes` FROM `recipe`where side_dishes >= 0 ORDER BY RAND() LIMIT 7";
                         $result = mysqli_query($db,$query) or die(mysqli_error($db));
								
			while($row = mysqli_fetch_array($result)){
                        #     print_r ($row);
                             $main[$i] = $row;
                             $i++;
                         #    echo "<br/>";				
			}	
                        return $main;
                                             
                        }
                        
                        
                        
                        
                        
                        
                        #Randomly get side dishes from the database, get ones that are not currently being used;
                        #inputs: $db, number of sides to get, array of side dish recipe ids that are already in use
                        function generateSideDishes ($db, $num, $side_ids){
                        $sides = array();
                        $i =0;
                     
                            #generate part of the sql query
                            #select * from recipes where recipe.side_dishes = -1 AND recipe.recipe_id != ... ORDER BY RAND() LIMIT $num;
                            $query = "SELECT DISTINCT recipe_id FROM recipe WHERE side_dishes = -1";
                         if (count($side_ids) != 0){
                            foreach ($side_ids as $id){
                                $query = $query." AND recipe.recipe_id != ".$id;      
                            }
                         }
                            $query = $query." ORDER BY RAND() LIMIT ".$num;
                                                     $result = mysqli_query($db,$query) or die(mysqli_error($db));
						
                                                    
			while($row = mysqli_fetch_array($result)){
                            $sides[$i]=$row;
                            $i++;
                        }
                      
                       
                        return $sides;
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
							<a href="mealPlan.php">Meal Plan</a>
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