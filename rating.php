<html>
<body>

<?php
session_start();

include "db_connect.php";
		if (!isset($_SESSION['email'])){
		?><meta http-equiv = "REFRESH" content="0;url=login.html"><?php } 

//<p> You can rate recipes on this site as well.</p>

//sets up the label
//<label for="rating">Rating For This Recipe:</label>

//sets up input for the rating label
//<input type="text"> id="rating" name="rating" /><br />

//$new_rating = rating;
//db is called, mealplanner
//$query= "INSERT INTO mealplanner(rating)VALUES(rating)";
// how to do it is in modifyrecipe

//it should look something like this
//UPDATE recipes SET rating = $new_rating WHERE recipe_id = $rec_id

if(isSet($_GET['id'])) {
	$rec_id = $_GET['id'];
  }
$rec_id = $_GET['id'];

$new_rating = $_GET['newRating'];


$update_ingred = "UPDATE recipes SET rating =".$new_rating."WHERE recipe_id =".$rec_id; // query

mysqli_query($db, $update_ingred) OR DIE (mysql1_error($db)); // querying the db

// under the query
echo "<a href = browseRecipes.php>Continue</a>";



//html page
// page that says "successfully" updated the rating, then loops back to the html page

?>
</html>
</body>


