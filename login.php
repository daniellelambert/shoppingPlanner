<?php
	session_start();
		include "db_connect.php";
		$email = $_POST['email'];
		$pw = $_POST['password'];
		echo $pw . "<br/>";
		echo $email;
		$query = "SELECT * FROM users WHERE email = '$email' AND password = SHA('$pw')";
		$result = mysqli_query($db, $query);
		if ($row = mysqli_fetch_array($result)){
			$_SESSION['email'] = $row['email'];
			?><html> <meta http-equiv = "REFRESH" content="0;url=index.html"> </html>
		<?php
		}
		else{
			echo "<p> Account not found </p>";
			?><html><meta http-equiv = "REFRESH" content="10;url=login.html"></html><?php
		}
	
	?>
