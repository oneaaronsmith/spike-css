<?php include('common/pageHeader.php'); ?>
<?php include('common/pageNavbar.php'); ?>

<div class="jumbotron text-center">
	<h1>Learn</h1> 
	<p>Please choose a subject you would like to know more about.</p>
 </div>
  
<div class='container'>
	<div class='row'>
		<div class='col-sm-4 text-center'>
			<button class='btn' id='btn-genes'>Genes</button>
		</div>
		<div class='col-sm-4 text-center'>
			<button class='btn' id='btn-dna'>DNA</button>
		</div>
		<div class='col-sm-4 text-center'>
			<button class='btn' id='btn-proteins'>Proteins</button>
		</div>
	</div>
	<hr>


	<div class='row text-center' id='geneVideo' style='display: none;'>
		<h3>Genes</h3>
		<div class='col-sm-12 embed-responsive-4by3'>
		<iframe width="560" class="embed-responsive-item" height="315" src="https://www.youtube.com/embed/5MQdXjRPHmQ" frameborder="0" allowfullscreen></iframe>
		</div>
		<p>Genes are tight</p>
	</div>
	
	<div class='row text-center' id='dnaVideo' style='display: none;'>
		<h3>DNA</h3>
		<div class='col-sm-12 embed-responsive-4by3'>
		<iframe width="560" class="embed-responsive-item" height="315" src="https://www.youtube.com/embed/zwibgNGe4aY" frameborder="0" allowfullscreen></iframe>
		</div>
		<p>DNA is pretty cool.</p>
		
	</div>
		
	<div class='row text-center' id='proteinVideo' style='display: none;'>
		<h3>Proteins</h3>
		<div class='col-sm-12 embed-responsive-4by3'>
		<iframe width="560" class="embed-responsive-item" height="315" src="https://www.youtube.com/embed/qBRFIMcxZNM" frameborder="0" allowfullscreen></iframe>
		</div>
		<p>Proteins are the bane of my existence</p>
	</div>
</div>
<script>
	$("#btn-genes").click(function () {
		$("#geneVideo").fadeToggle('hide');
		$("#dnaVideo").hide();
		$("#proteinVideo").hide();
	});
	$("#btn-dna").click(function () {
		$("#dnaVideo").fadeToggle('hide');
		$("#geneVideo").hide();
		$("#proteinVideo").hide();
	});
	$("#btn-proteins").click(function () {
		$("#proteinVideo").fadeToggle('hide');
		$("#geneVideo").hide();
		$("#dnaVideo").hide();
	});
</script>

<?php include('common/pageFooter.php'); ?>