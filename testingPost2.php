<html>
<body>

<?php
session_start();
#Need to do mysqli escape!
	include "db_connect.php";
	
$recipe = $_POST;
$recipe_name = $recipe['Dish_Name'];
$directions = $recipe['directions'];

echo "name: ".$recipe['Dish_Name']."<br/>";
echo "directions: ".$recipe['directions']."<br/>";
#inserting recipe into database
	#check if the name is in use
	$dish_name_check = "SELECT * FROM recipe WHERE recipe_name='$recipe_name'"; 
	$rec_result = mysqli_query($db, $dish_name_check);
	$r_row = mysqli_fetch_array($rec_result);
	if ($r_row != null){
	#return error if it is (not completed, just dieing if it's already in DB)
	die ("Recipe already exists in database!");
	}
	#recipe order: id, name, description, instructions(directions), cook_time, rating, comments, last_cook_week, date_added, side_dishes, pic_location
			#Add it to database, remember to add dummy values for any slots not filled in
	$insert_recipe =  "INSERT INTO recipe VALUES (null, '".$recipe_name."', 'placeHolder','".$directions."', '00:00:00', 1, 'placeholder', '0000-00-00', CURDATE(), -1, 'placeholder')";
	 $result_insert_food =mysqli_query($db, $insert_recipe) OR DIE (mysqli_error($db));




#Inserting ingredients

#Start with adding food
foreach ($recipe['food'] as $k => $v){
echo "here! <br/>";
print_r ($v);
echo "<br/> <br/>";

#check if food is in DB,
$food_result = getFood($v['Food_Name'], $db);
if ($food_result == null){
#if it isn't in the db, add it.
 echo "<h3>Inserting food into db!</h3>  ".$v['Food_Name']."<br/>";
 $insert_food =  "INSERT INTO food VALUES (null, '".$v['Food_Name']."', 'placeHolder')";
 $result_insert_food =mysqli_query($db, $insert_food) OR DIE ("ERROR INSERTING FOOD".$insert_food);
 if ( $result_insert_food == false){
	echo "ERROR inserting food";
 }
 #getting food again (for food_id)
 $food_result = getFood($v['Food_Name'], $db);
 
 }
#Adding ingredient
 echo $food_result['food_id']."    I'm here!";
 $amt = $v['Amt'];
 $unit = $v['Unit'];
 $insert_ingredient = "INSERT INTO ingredient VALUES ((select MAX(food.food_id) from food), (select MAX(recipe.recipe_id) from recipe), '$amt', '$unit')";
	$result_insert_ingredient =mysqli_query($db, $insert_ingredient) OR DIE (mysqli_error($db));
 }

?>

</body> </html>

<?php 
function getFood ($food_name, $db){
$query = 'Select * from food where food_name="'.$food_name.'"'; 

$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result);
return ($row);

}


?>