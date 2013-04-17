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
						<span>Create A New Meal Plan!</span>
						<ul>

								
							</li>
						</ul>
					</div>
					<div>
						<ul>
							<li>
        <?php
        #start date
        #meal plan
        
        echo "<b>Meal Plan </b></br></br>";
    	echo "<form action='insertMealPlan.php' method='POST'>" ;
    	for ($i = 0; $i < 7; $i++){
    	
    		echo "<b> Day - ".$i."</b></br>";
    	
    		echo "Main Dish: ";
                $x = getMainDishOptions($i, $db);
                echo $x;
                
echo "<div id='sideDiv".$i."'>  </div><br/> <input type='button' value='Add Side Dishes!' 
                                                    onClick='add_Side(".$i.");'> <br/>";

              
echo "</br></br>";
    	
    	
    	}
        
        
    	echo "<input type='submit' value='submit meal plan' > </form>";
         

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




<?php 
function getMainDishOptions ($day, $db){
    $query = "Select recipe_name, recipe_id from recipe where side_dishes >= 0";
	$result = mysqli_query($db,$query) or die("Error Querying Database");	
      
    //  $option = "<select name=meals[".$day."][0]>";
      echo "<select name=meals[".$day."][0]>";
        while($row = mysqli_fetch_array($result)){
              // $option = $option + "<option value='".$row['recipe_id']."'>".$row['recipe_name']." </option>";
               echo "<option value='".$row['recipe_id']."'>".$row['recipe_name']." </option>";
             //print_r ($row);
              // echo "<br/><br/>";
         }
         
    //     $option = $option +"</select>";
      echo "</select>";
         //echo $option;
        //return $option;    
}

function getSideDishesOptions ($db){
    $query = "Select recipe_name, recipe_id from recipe where side_dishes < 0";
	$result = mysqli_query($db,$query) or die("Error Querying Database");	
      echo "'";
       while($row = mysqli_fetch_array($result)){
               echo "<option value=".$row['recipe_id'].">".$row['recipe_name']." </option>";
               
         }
         echo "'";
}
                


        
        ?>
</html><script type='text/javascript'>
/*var mainCheck = document.getElementById('mainCheck');
var dishChecker = document.createElement('div');
dishChecker = setAttribute('id', 'dish_checker');

dishChecker.innerHTML = ("");
mainCheck.appendChild (dishChecker);
*/

var side_nums = [0,0,0,0,0,0,0];

function add_Side(id){
var content=document.getElementById('sideDiv'+id);
var newBox=document.createElement('div');
var temp = '<select name="meals['+id+']['+side_nums[id]+']">' + <?php  getSideDishesOptions ($db); ?> + '</select>';
newBox.innerHTML = (temp);
content.appendChild (newBox);
side_nums[id]++;

										
};

</script>

</html>