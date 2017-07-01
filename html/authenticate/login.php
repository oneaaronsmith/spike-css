<?php

	function authenticate($user,$pass) {
		require_once('/var/www/html/database/database.php');
		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);

		if(mysqli_connect_error())
				echo "Connection to database failed: " . mysqli_connect_error();

		if($stmt = mysqli_prepare($conn, "SELECT * FROM Authentication WHERE username=? AND password=?")) {
			mysqli_stmt_bind_param($stmt,'ss', $user,$pass);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);

			if(mysqli_stmt_num_rows($stmt) == 0) {
				echo "<div class='text-center error'>Error: Username or password is incorrect.</div>";
				mysqli_stmt_free_result($stmt);
				mysqli_stmt_close($stmt);
			}
			else {
				mysqli_stmt_free_result($stmt);
				setcookie("user",$user);
				mysqli_stmt_close($stmt);
				header("Refresh:0");
			}
		}

		mysqli_close($conn);
	}

	function logout() {
		// Clear the cookies.
		setcookie('user', '', time()-3600);
		setcookie('name', '', time()-3600);
		header("Refresh:0");
	}
?>
