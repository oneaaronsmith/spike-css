<!--This page is show after a user selects the "save" button on a gene of interest-->

<?php require('common/pageHeader.php'); ?>
<?php include('common/pageNavbar.php'); ?>

  <div class="jumbotron text-center">
    <h1>Save Result</h1> 
    <p>Saved genes can be viewed in your personal library.</p> 
  </div>
  
<div class='container-fluid searchPage'>
	<hr>
</div>

<?php   
	$reference	= $_POST['reference'];
	$protein	= $_POST['protein'];
	$taxonomy 	= $_POST['taxonomy'];
	$organism 	= $_POST['organism'];
	$summary	= $_POST['summary'];
	$username 	= $_COOKIE['user'];
	
	require_once('/var/www/html/database/database.php');
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
	
	if(mysqli_connect_error())
		echo "Connection to database failed: " . mysqli_connect_error();
	
	/*username VARCHAR(30),
	reference VARCHAR(20),
	protein VARCHAR(50),
	organism VARCHAR(20),
	taxonomy VARCHAR(30),
	summary TEXT,*/
	
	if($stmt = mysqli_prepare($conn, "INSERT INTO Genes VALUES (?,?,?,?,?,?)")) {
		mysqli_stmt_bind_param($stmt,'ssssss', $username, $reference, $protein, $organism, $taxonomy,$summary);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		echo "<h2 class='text-center'>Your gene was added successfully!</h2><hr>";
	}
	else {
		echo "<h2 class='text-center'>Error: Gene could not be added to your library.</h2><hr>";
	}
	mysqli_close($conn);
?>

<?php require('common/pageFooter.php'); ?>