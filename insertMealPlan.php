<?php
session_start();

#start date
        include "db_connect.php";
				if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
$plan = $_POST;



        $insertPlan = "INSERT INTO meal_plan VALUES (null, CURDATE(), 'placehodler')"; 
         $result_insert_plan =mysqli_query($db, $insertPlan) OR DIE (mysqli_error($db));

 //insert meal plan

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
//connect meal and meal plan
         $m_insert = "INSERT INTO meal_connector VALUES (".$mealsID[$j][0].",(select MAX(meal_plan.meal_plan_id) from meal_plan))";
             $result_insert_dish =mysqli_query($db, $m_insert)OR DIE (mysqli_error($db));
         
            //insert dishes
         foreach ($plan['meals'][$j] as $meal){
              
              $dish_insert = "INSERT INTO dish VALUES (".$meal.", ".$mealsID[$j][0].")";
             $result_insert_dish =mysqli_query($db, $dish_insert) OR DIE (mysqli_error($db));
         }
         }
        
        
#insert/create meal plan
       /* 
        $insertPlan = "INSERT INTO meal_plan VALUES (null, $start_date, 'placehodler')"; 
         $result_insert_plan =mysqli_query($db, $insertPlan) OR DIE (mysqli_error($db));
               foreach ($mealsID as $mid){
                 echo "13<br/>";
             //print_r($mid);
             $m_insert = "INSERT INTO meal_connector VALUES (".$mid[0].",(select MAX(meal_plan.meal_plan_id) from meal_plan))";
             $result_insert_dish =mysqli_query($db, $m_insert)OR DIE (mysqli_error($db));
             echo "14<br/>";

          
         } 
        */
         

	echo "<p><a href=\"index.php\">Continue</a></p>";	

?>
