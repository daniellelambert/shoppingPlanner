<?php
session_start()

	include "db_connect.php";
			if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 
    echo "1<br/>";
#generate main dish
        $meals = array();
        $mainDish = array();
        $mainDish = generateMainDishes($db);
     #generate side dishes
        $i = 0;
        $sides = array();
        $ids = array();
            echo "2<br/>";

            
            #Generates sides for each main dish. All sides choosen are unique for that week
        foreach ($mainDish as $main){
               $sides[$i] = generateSideDishes($db, $main['side_dishes'], $ids);
      #adding the side dish ids, to make sure recipes aren't reused
               
               foreach ($sides[$i] as $s){
                   array_push($ids, $s['recipe_id']);           
               }
               echo "<br/> main dish ----";
               print_r ($main);
               echo "<br/><br/>";
               
               foreach ($sides[$i] as $s){
                  echo "SIDE -- ";
                   print_r ($s);
                  echo"<br/><br/>";
               }
               echo "<br/><br/><br/><br/>";
               
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
                 echo "13<br/>";
             //print_r($mid);
             $m_insert = "INSERT INTO meal_connector VALUES (".$mid[0].",(select MAX(meal_plan.meal_plan_id) from meal_plan))";
             $result_insert_dish =mysqli_query($db, $m_insert)OR DIE (mysqli_error($db));
             echo "14<br/>";

             
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
