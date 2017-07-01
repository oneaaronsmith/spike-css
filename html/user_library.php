<?php include('common/pageHeader.php'); ?>
<?php include('common/pageNavbar.php'); ?>
<?php	
		if(isset($_COOKIE['user']) == FALSE) {
			header("Location: http://mygenefinder.com");
		}
?>
  <div class="jumbotron text-center">
    <h1>Your Gene Library</h1> 
    <p>Any genes that you have saved will show below.</p> 
  </div>
  
<div class='container-fluid searchPage'>
	<?php showLibrary(); ?>
	
</div>

<?php
	function showLibrary() {
		if(isset($_COOKIE['user'])) {
		
			$username = $_COOKIE['user'];
			
			require_once('/var/www/html/database/database.php');
			$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
			
			//Announce error if there was one.
			if(mysqli_connect_error())
					echo "Connection to database failed: " . mysqli_connect_error();
				
			//Make the query
			$result = mysqli_query($conn, "SELECT * FROM Genes WHERE username='$username'");
			
			echo "<div class='row'>";
				echo "<div class='col-md-2'><h3>Gene</h3></div>";
				echo "<div class='col-md-2'><h3>Protein</h3></div>";
				echo "<div class='col-md-3'><h3>Organism/Taxonomy</h3></div>";
				echo "<div class='col-md-5'><h3>Summary</h3></div>";
			echo "</div>";
			echo "<hr>";
			
			//Include table data
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<div class='row'>";
				
				echo "<div class='col-md-2'>" . $row['reference'] . "</div>";
				echo "<div class='col-md-2'>" . $row['protein'] . "</div>";
				echo "<div class='col-md-3'>" . $row['organism'] . ",	" . $row['taxonomy'] . "</div>";
				echo "<div class='col-md-5'>" . $row['summary'] . "</div>";
				
				echo "</div>";
				echo "<div><hr></div>";
			}
			

			//Close the connection
			mysqli_close($conn);
		}
		else {
			echo "Failed to retrieve your library";
		}
	}
?>

<?php include('common/pageFooter.php'); ?>