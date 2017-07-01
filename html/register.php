<?php 
	require('common/pageHeader.php'); 
	include('common/pageNavbar.php');
?>

<div class='jumbotron text-center'>
	<h1>Account Registration</h1>
	<p>With a gene finder account,you will be able to save gene information and come back to it later! All passwords are encrypted for your safety.</p>
</div>


<div class="container">
	<div class='form-group'>
	<form action="" method="post">
		<input type='text' name='uname' class='form-control' placeholder='Username'><br>
		<input type='text' name='fname' class='form-control' placeholder='First Name'><br>
		<input type='text' name='lname' class='form-control' placeholder='Last Name'><br>
		<input type='password' name='pass1' class='form-control' ' placeholder='Password'><br>
		<input type='password' name='pass2' class='form-control' placeholder='Confirm Password'><br>
		<input type='submit' class='btn' class='form-control' name='submit' value='Make my account'>
	</div>
</div>

<?php
	function registerUser() {
		if(isset($_POST['submit'])) {
			
			$username= $_POST['uname'];
			$fname	= $_POST['fname'];
			$lname 	= $_POST['lname'];
			$pass1	= $_POST['pass1'];
			$pass2	= $_POST['pass2'];
			
			if($username == "" || $fname == "" || $lname == "" || $pass1 == "" || $pass2 == "") {
				echo "<div class='text-center'>Error: Please fill out entire form before submitting your registration</div>";
				return;
			}
			if($pass1 != $pass2) {
				echo "<div class='text-center'>Error: Your passwords do not match</div>";
				return;
			}
			
			require_once('/var/www/html/database/database.php');
			$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
			
			if(mysqli_connect_error()) {
				echo "Connection to database failed: " . mysqli_connect_error();
			}
			
			
			$result = mysqli_query($conn, "SELECT * FROM Authentication WHERE username LIKE '$username'");
			
			$num_rows = mysqli_num_rows($result);
					
			if($num_rows != 0)
			{
				echo "<div class='text-center'> That username is already in use. Please try again.</div>";
				return;
			}
			
			if($stmt = mysqli_prepare($conn, "INSERT INTO Authentication VALUES (?,?,?,?)")) {
				mysqli_stmt_bind_param($stmt,'ssss', $username, $fname, $lname, $pass1);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				
				echo "<div class='text-center'> Congratulations! You are now registered!</div>";
			}
			else {
				echo "<div class='row text-center'>Error: Registration failed.</div>";
			}
			
			mysqli_close($conn);
		}
	}
	registerUser();
?>
<?php require('common/pageFooter.php'); ?>