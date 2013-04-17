<?php
session_start()

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
        
        print_r ($v);
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
           
        
           print_r ($v);
        echo "  Else Statement <br/>";
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
       }
                      
        }
        
        
 
        }


	#else (meaning insert need ingredient to the DB
			#check DB for Food name
				#if it is
					#insert into ingredient values ($recipe.name, food_id from DB check, amt, units);
				#else
					#insert into food values (null, food[i][food_name], 'placehold')
					#insert into ingredient values ($recipe.name, (select MAX(food.food_id) from food), amt, units);
					
#redirect back to recipe page
echo "<p><a href=\"index.html\">Continue</a></p>";
?>



<?php
function getFood ($food_name, $db){
$query = 'Select * from food where food_name="'.$food_name.'"'; 

$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result);
return ($row);

}
?>