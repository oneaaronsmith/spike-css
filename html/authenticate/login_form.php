<div id="navbar" class="navbar-collapse collapse">
	<form class="navbar-form navbar-right" action="" method="post">
		<div class="form-group">
		  <input type="text" placeholder="Username" name='username' class="form-control">
		</div>
		<div class="form-group">
		  <input type="password" placeholder="Password" name='password' class="form-control">
		</div>
		<button type="submit" name="login-submit" class="btn">Sign in</button>
	</form>
	<?php
		include('login.php');
		
		if(isset($_POST['login-submit'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			authenticate($username,$password);
		}
	?>
</div><!--/.navbar-collapse -->