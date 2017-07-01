<?php
	require('common/pageHeader.php');
	include('common/pageNavbar.php');
	
	//remember him http://ec2-34-195-155-88.compute-1.amazonaws.com/learn.php
?>
    
	<div class='jumbotron text-center' id='homejumbo'>
		<h1>Welcome to My Gene Finder!</h1>
		<p>This website can be used as a tool for researching genes. If you create an account, you can save gene searches
			to a personal library and come back to them later!</p> 
	</div>

    <div class="container choices">

      <!-- Three columns of choices-->
      <div class="row">
        <div class="col-md-4">
          <img src="../images/dna-helix.png" alt="Science" width="140" height="140">
          <h2>Learn</h2>
          <p>View videos about the functionality of genes and proteins.</p>
          <p><a class="btn btn-default" href="learn.php" role="button">Learn</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4">
          <img src="../images/project_search.png" alt="Search" width="140" height="140">
          <h2>Search</h2>
          <p>Use this website's search tool to gather information on genes.</p>
          <p><a class="btn btn-default" href="search.php" role="button">Search Page</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4">
          <img src="../images/project_save.png" alt="Save" width="140" height="140">
          <h2>Save</h2>
          <p>For account users only. Save your gene searches for fast reference when you return.</p>
          <p><a class="btn btn-default" href="register.php" role="button">Register an Account</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">What is a gene?<span class="text-muted"></span></h2>
          <p class="lead">A gene is a section of DNA that encodes a particular protein product. We have an estimated 19,000-20,000 genes in our DNA. Although, the number of genes an organism has doesn't necessarily mean that it is more complex. A water flea has 30,000 genes.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" src="images/geneexplain.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Okay, but what is DNA?<span class="text-muted"></span></h2>
          <p class="lead">DNA is a molecule made up of long strands of four bases; Adenine, Guanine, Tyrosine, and Cytosine. Certain sequences of these bases, called genes, can be read and interpretted by other molecules to make a protein.</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block img-rounded" src="images/dna-structure.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Why care about proteins?<span class="text-muted"><br></span></h2>
          <p class="lead">Proteins are molecules that carry out all of the work in your cells. Antibody proteins protect you from bacteria and viruses. Enzymes help the necessary chemical reactions to take place and are the class of protein capable of reading DNA. 
		  Messenger proteins like hormones signal other parts of your body to act a certain way. Structural proteins provide support for your cells. Finally, transport proteins carry small molecules around your body to where they are needed.  </p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="images/hemoglobin.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">
    </div><!-- /.container -->

<?php require('common/pageFooter.php'); ?>