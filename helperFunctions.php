<?php
session_start();
  
        include "db_connect.php";
		
		
		
        
//uncomment this and run it once to insert a mock meal plan into the DB
//Chances are it will take about a mintue to put everything into the DB.
//makeTestMealPlan ($db);

        
//In order to get this code to work
//Change the 7 in: readableTest(getMealPlan (7, $db) to the id of the meal plan in your DB.
//        makeTestMealPlan($db);

if (ISSET($db)){
    echo "<textarea cols=100 rows='100' cols='300'>";
    readableTest(getMealPlan (16, $db), 0);
 echo "</textarea>";

        
    }
 

function readableTest ($test, $tabs){
	
	
 		
        foreach ($test as $k=>$v){
            for ($i = 0; $i < $tabs; $i++){
                echo "\t";
     
            }
           if (is_array($v)){
               echo $k." {\n";
               readableTest($v, ($tabs+1));
               
            for ($j = 0; $j < $tabs; $j++){
                echo "\t";
     
            }
               echo "} ".$k."\n";
               
           }
            else{
                 echo $k. "  => ".$v;
                  echo "\n";
            }
               
            }
			
        echo "\n";
  		
  
	#print_r($test);  

}
#Takes a meal plan ID and returns the meal plan
    #get meal plan
        #get meals
        #get recipes
            

/*
 * Format
 *  cook_week
 *  [meals]
 *          [0]
 *              cook_date
 *              [dishes]
 *                      [0]
 *                          recipe_name
 *                          ..
 *                              [ingredients]
 *                                      [0]
 *                                            amount
 *                                            units
 *                                            food_id
 *                                            food_name
 *                                      [1]
 *                                            ...
 *                        [1]
 *                              recipe stuff
 *                        [2]
 *                              recipe stuff
 * 
 *              [1]
 *                  cook_date          
 *                  [dishes]
 *                          [0]
 */                 
function getMealPlan ($plan_ID, $db){
    $plan = array();    
    $query = "select * from meal_plan where meal_plan_id = ".$plan_ID;
    $result = mysqli_query($db,$query) or die("Error Querying Database");	
    $plan = mysqli_fetch_array($result);

    $connect_query = "SELECT * FROM `meal_connector` WHERE `meal_plan_id`=$plan_ID";
    
    $result2 = mysqli_query($db,$connect_query) or die(mysqli_error($db));
    $i = 0;
    
    while ($row = mysqli_fetch_array($result2)){
      
    /*    echo "<br/> ".$i;
        print_r ($plan['meals'][$i]);
        echo "<br/><br/>";
      */
        $plan['meals'][$i] = get_meal($row['meal_id'], $db);
     
        $i++;
    }
    return $plan;

}
/*
 * Format
 *      [0]
 *          food_name
 *          ...
 *      [1]
 *           food_name
 * 
 */
function get_ingredients ($recipe_id, $db){
    $ingredientQuery = "SELECT ingredient.*, food.* FROM ingredient INNER JOIN food on ingredient.food_id=food.food_id where ingredient.recipe_id=".$recipe_id;
	$result2 = mysqli_query($db,$ingredientQuery) or die("Error Querying Database");
        $ingredients = array();
        $i = 0;
	 while ($ingredients [$i] = mysqli_fetch_array($result2)){
             $i++;
         }
    return $ingredients;
}

#Returns a recipe array
    /*
     * Format
     *      recipe_name
     *      ...
     *          ingredients
     *              [0]
     *                      food_name
     *                      ...
     * 
     * 
     */
function get_recipe ($recipe_id, $db){
        $query = "Select * from recipe where recipe_id=$recipe_id";
	$result = mysqli_query($db,$query) or die("Error Querying Database");	
       $recipe = mysqli_fetch_array($result);
        $recipe['ingredients'] = get_ingredients($recipe_id, $db);
        return $recipe;    
        }
#Returns  array
        
       /*
        * Format
        *   [0]
        *       
        * 
        * 
        */ 
function get_meal ($meal_id, $db){
    $query = "Select * from meal where meal_id=".$meal_id;
    $result = mysqli_query($db,$query) or die("Error Querying Database");	
    $meal = mysqli_fetch_array($result);
    
    $dish_query = "Select * from dish where meal_id=".$meal_id;
        $result2 = mysqli_query($db,$dish_query) or die("Error Querying Database");	
	
    $i = 0;
  while($dish = mysqli_fetch_array($result2)){
        $meal['dishes'][$i] = get_recipe ($dish['recipe_id'], $db);
        $i++;
    }
    return $meal;
 }
 
 #only need to call once, will, this makes a test meal. 
 #7 meals each meal has 3 recipes
    function makeTestMealPlan ($db){
        ini_set('max_execution_time', 300);
      echo "0<br/>";
    $mealIDs = array();
      echo "0<br/>";
  #inserting test meals      
for ($i = 1; $i < 8; $i++) {      
       #inserting recipe tests, 1 main dish and 3 side dishes each. they are named aptly
        #main dish
         echo "0<br/>";
       $recipeIDs=array();
             echo "0<br/>";
                                              #ID     NAME             DESCRIPTION           DIRECTIONS    COOK TIME   RATE    COMMENT             LAST COOK   TIMESTAMP  SIDE  PICTURE    
        $insert_M =  "INSERT INTO recipe VALUES (null, 'MainDish $i', 'This is the main dish', 'No directions ', '00:15:00', 1, 'Comment For Main Dish', 0000-00-00, CURDATE(), 3, 'placeholder')";
	$result_insert_food =mysqli_query($db, $insert_M) OR DIE (mysqli_error($db));
    echo "1<br/>";
         
        $q_M = "select MAX(recipe_id) from recipe";
        $result2 = mysqli_query($db,$q_M) OR DIE (mysqli_error($db));	
	$recipeIDs[0] = mysqli_fetch_array($result2);         
        echo "2<br/>";
        #making fake ingredient + food
         for ($z = 0; $z < 4; $z++){
               echo "3<br/>"; 
                $insert_food =  "INSERT INTO food VALUES (null, 'Food-".$i."-0-".$z."', 'placeHolder')";
                $result_insert_food =mysqli_query($db, $insert_food) OR DIE (mysqli_error($db));
         echo "4<br/>";
                $insert_ingredient = "INSERT INTO ingredient VALUES ((select MAX(food.food_id) from food), (select MAX(recipe.recipe_id) from recipe), 1, 'cups')";
                $result_insert_ingredient =mysqli_query($db, $insert_ingredient) OR DIE (mysqli_error($db));
            echo "5<br/>";
                
         }
                 
         
         
        
         for ($j = 1; $j < 4; $j++){
             $insert_sideRecipe =  "INSERT INTO recipe VALUES (null, 'Side Dish".$i."-".$j."', 'This is side dish".$i."-".$j."','No directions".$i."', '00:15:00', 1, 'Comment For Side Dish".$i."-".$j."', '0000-00-00', CURDATE(),-1, 'placeholder')";
             $result_insert_food =mysqli_query($db, $insert_sideRecipe) OR DIE (mysqli_error($db));      
             echo "6<br/>";
             $q_Side = "select MAX(recipe_id) from recipe";
             $result2 = mysqli_query($db,$q_Side) OR DIE (mysqli_error($db));	
             $recipeIDs[$j] = mysqli_fetch_array($result2);
             echo "7<br/>";
             #making fake ingredient + food
         for ($z = 0; $z < 4; $z++){
                echo "8<br/>";
                $insert_food =  "INSERT INTO food VALUES (null, 'Food-".$i."-".$j."-".$z."', 'placeHolder')";
                $result_insert_food =mysqli_query($db, $insert_food) OR DIE (mysqli_error($db));
             echo "9<br/>";
                $insert_ingredient = "INSERT INTO ingredient VALUES ((select MAX(food.food_id) from food), (select MAX(recipe.recipe_id) from recipe), 1, 'cups')";
                $result_insert_ingredient =mysqli_query($db, $insert_ingredient) OR DIE (mysqli_error($db));
            echo "10<br/>";
                
            }
             
         }

         #Making the Meal
         $insert_meal =  "INSERT INTO meal VALUES (null, DATE_ADD(CURDATE(),INTERVAL ".$i." DAY))";
         $result_insert_meal =mysqli_query($db, $insert_meal) OR DIE (mysqli_error($db));
  echo "11<br/>";
         $meal_id_select = "SELECT MAX(meal.meal_id) from meal";
         $result_meal_id = mysqli_query($db, $meal_id_select);
         $mealIDs[$i] = mysqli_fetch_array($result_meal_id);
         echo "12<br/>";
         #inserting dishes
         foreach ($recipeIDs as $rid){
             print_r ($rid);
             $dish_insert = "INSERT INTO dish VALUES (".$rid[0].",(select MAX(meal.meal_id) from meal))";
             $result_insert_dish =mysqli_query($db, $dish_insert) OR DIE (mysqli_error($db));
         echo "13 <br/>";
             
         }
         }
         
        #making meal plan
         $insert_meal_plan = "INSERT INTO meal_plan VALUES (null, DATE_ADD(CURDATE(),INTERVAL 1 DAY), 'placeholder')";
         $result_insert_plan = mysqli_query($db, $insert_meal_plan) OR DIE (mysqli_error($db));
         echo "14<br/>";
         #connect meals and meal plan
         foreach ($mealIDs as $mid){
             print_r($mid);
             $m_insert = "INSERT INTO meal_connector VALUES (".$mid[0].",(select MAX(meal_plan.meal_plan_id) from meal_plan))";
             $result_insert_dish =mysqli_query($db, $m_insert)OR DIE (mysqli_error($db));
         echo "15<br/>";
             
         }
         
         echo "Successful!";
    }


		
		
		//In order to get this code below to work
		//Change the 7 in: getMealPlan (7, $db) to the id of the meal plan in your DB.
/*		$mealPlan = getMealPlan (7, $db);
		$_SESSION['mealPlanArray'] = $mealPlan;
    
		echo "<form id='formID' action='recipeListPDF.php' method='POST' target=\"_blank\"> <input type='submit' value='Get Recipe List' /> </form><br/>";
		echo "<form id='formID' action='shoppingListPDF.php' method='POST' target=\"_blank\"> <input type='submit' value='Get Shopping List' /> </form><br/>";
	
*/	   
?>
