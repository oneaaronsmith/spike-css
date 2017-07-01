<div id="navbar" class="navbar-collapse collapse">
	<form class="navbar-form navbar-right" action="" method="post">
		<div class='form-group'>
			<span class='loggedIn'> Logged in as <?php echo " " . $_COOKIE['user']; ?></span>
		<button type="submit" name="logout-submit" class="btn">Signout</button>
		</div>
	</form>
	<?php
		include('login.php');
		
		if(isset($_POST['logout-submit'])) {
			logout();
			header("Refresh:0");
		}
			
	?>
</div><!--/.navbar-collapse -->