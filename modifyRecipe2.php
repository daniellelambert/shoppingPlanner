<?php
#Still working on actually updating the recipe. 

#psuedo code for it
	#Update the values with all the stuff gotten from the user (update recipe set name=$_POST['name']... where recipe_id=$recipe.id)
#for ingredients
	#if food[i][food_id] != null
		#if food[i][delCheck] === on
			#delete ingredient from DB
		#else 
			#update ingredient set amount=food[i]['amt']... where recipe_id=$recipe.id && food_id=food[i][food_id]; 
			#update food set food_name=food where food.id=food[i][food_id];
	#else (meaning insert need ingredient to the DB
			#check DB for Food name
				#if it is
					#insert into ingredient values ($recipe.name, food_id from DB check, amt, units);
				#else
					#insert into food values (null, food[i][food_name], 'placehold')
					#insert into ingredient values ($recipe.name, (select MAX(food.food_id) from food), amt, units);
					
#redirect back to recipe page
		$recipe = $_POST;

print_r ($recipe);

?>