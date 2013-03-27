<html>
<body>
<?php
  
include "db_connect.php";

#delete 

  if(isSet($_POST['id'])) {
	$rec_id = $_POST['id'];

		
		$q2 = "delete from recipe where recipe_id = $rec_id";
		$q3 = "delete from ingredient where recipe_id = $rec_id";
		$result2 = mysqli_query($db,$q2) or die("Error Querying Database: recipe");
		$result3 = mysqli_query($db,$q3) or die("Error Querying Database: ingredients");
		
		echo "That recipe was deleted.It tasted bad anyway. ";
	
	}
	else {
		echo "An error has occured somewhere";
	}
	echo  "<p><a href=\"index.html\">Continue</a></p>";


 ?>
</table>
</div>

</body>
</html>
