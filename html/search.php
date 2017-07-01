<?php include('common/pageHeader.php'); ?>
<?php include('common/pageNavbar.php'); ?>

<!--<script type="text/javascript" src="search.js"></script>-->
<script>
	/*This function is used to display information concerning genes using GET, ajax, and the National Center for Biotechnology Information Public API known as "entrez"
	  It is used with the function getGeneSummary(), which uses the gene list initially returned from the NCBI to get summaries of the gene*/
	function getGeneXMLContent() {
	
			//Set up variables for making the request:
			var search = $('#searchvalue').val(); //Gets the user's search text
			console.log(search);
			var xmlHttp = new XMLHttpRequest(); //AJAX
			var baseUrl = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/'; //base url for NCBI api
			
			//Check for a change in the state
			xmlHttp.onreadystatechange = function() {
				if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					
					//If the document is ready, stop the load message
					document.getElementById('loadtext').innerHTML="";

					//Give the XML response text to a variable
					var list = xmlHttp.responseXML;
					
					//Initialize a variable to hold the ID data
					var idList = "";
					
					//Get the gene id list and store it in an array.
					geneId = list.getElementsByTagName('Id');
					console.log(geneId);
					
					//Concatenate the id array to a list needed for another XML request
					for (i = 0; i < geneId.length ; i++) {
						idList += geneId[i].childNodes[0].nodeValue + ",";
					}
					
					//There is an extra comma at the end of a list. The following will remove that comma:
					idList = idList.substr(0, idList.length - 1);
					console.log(idList);
					
					//Make another request to the NCBI for gene summaries based on that list.
					getGeneSummary(idList);
				}
			};
				
				//Before the document is loaded, display a loading message
				document.getElementById('loadtext').innerHTML="Loading Gene ID List...";
				
				//Log what request was sent.
				console.log(baseUrl + "esearch.fcgi?db=gene&term=" + search + "&usehistory=y");
				
				//The NCBI requests for limited database access, so I invoke a Timeout to delay requests.
				setTimeout( function() {
				
				//Direct the request and send it
				xmlHttp.open("GET", baseUrl + "esearch.fcgi?db=gene&term=" + search + "&usehistory=y",true);
				xmlHttp.send();
				},2000)
				
		}
		
		function getGeneSummary(id) {
			//Set up the request variables	
			var xmlHttp = new XMLHttpRequest();
			var base = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/';
			
			//Check for a change in the state
			xmlHttp.onreadystatechange = function() {
				if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					
					//If the document is ready, stop the load message
					document.getElementById('loadtext').innerHTML="";

					//Give the XML response text to a variable
					var list = xmlHttp.responseXML;
						
					//Initialize variables to hold the information
					var organismText = "";
					var taxonomyText = "";
					var referenceText = "";
					var proteinText = "";
					var chromosomeText = "";
					var summaryText = "";
					var saveOption = "";
					
					//Parse the xml content
					organism = list.getElementsByTagName('CommonName');
					console.log(organism);
					taxonomy = list.getElementsByTagName('ScientificName');
					console.log(taxonomy);
					geneReference = list.getElementsByTagName('Name');
					console.log(geneReference);
					protein = list.getElementsByTagName('Description');
					console.log(protein);
					summary = list.getElementsByTagName('Summary');
					console.log(summary);
					
					//Add headers to the webpage
					document.getElementById('geneHeader').innerHTML="<h3>Gene</h3>";
					document.getElementById('proteinHeader').innerHTML="<h3>Protein</h3>";
					document.getElementById('organismHeader').innerHTML="<h3>Organism/Taxonomy</h3>";
					//document.getElementById('taxonomyHeader').innerHTML="<h3>Taxonomy</h3>";
					document.getElementById('summaryHeader').innerHTML="<h3>Summary</h3>";
					document.getElementById('saveHeader').innerHTML="<?php if(isset($_COOKIE['user'])) { echo "<h3>Save<h3>";} ?>"; //Adds a save header if user is logged in.
					
					//Add divs for storing information to the webpage equal to the return number of genes
					for(j = 0; j < organism.length ; j++) {
					$(document.body).append("<div class='row'>")
					$(document.body).append("<div id='geneCode" + j + "' class='col-md-2'></div>")
					$(document.body).append("<div id='protein" + j + "' class='col-md-2'></div>")
					$(document.body).append("<div id='organism" + j + "' class='col-md-1'></div>")
					$(document.body).append("<div id='taxonomy" + j + "' class='col-md-2'></div>")
					$(document.body).append("<div id='summary" + j + "' class='col-md-4'></div>")
					$(document.body).append("<div id='save" + j + "' class='col-md-1 center'></div>")
					$(document.body).append("</div>")
					$(document.body).append("<div class='row'><div id='line" + j + "' class='col-sm-12'></div></div>");
					}
					
					//Fill the div with the information returned by NCBI
					for (i = 0; i < organism.length ; i++) {
						organismText = organism[i].innerHTML;
						document.getElementById("organism" + i).innerHTML = organismText;
					
						taxonomyText = taxonomy[i].childNodes[0].nodeValue;
						document.getElementById("taxonomy" + i).innerHTML = taxonomyText;
					
						referenceText = geneReference[i].childNodes[0].nodeValue;
						document.getElementById("geneCode" + i).innerHTML = referenceText;
					
						proteinText = protein[i].childNodes[0].nodeValue;
						document.getElementById("protein" + i).innerHTML = proteinText;
						
						if(summary[i].nodeValue != 'null') {
							summaryText = summary[i].innerHTML;
							document.getElementById("summary" + i).innerHTML = summaryText;
						}
						else if (summary[i].nodeValue == '') {
							summaryText = "No summary available";
							document.getElementById("summary" + i).innerHTML = summaryText;
						}
						
						document.getElementById("save" + i).innerHTML = "";
						
						//Check if there are user cookies
						if(document.cookie != "") {
							
							//If there are cookies, make variables fro the current content to fill a form with.
							//Save forms will be added so that the user can save a gene to their library.
							var organismInsert = document.getElementById("organism" + i).innerHTML;
							var taxonomyInsert = document.getElementById("taxonomy" + i).innerHTML;
							var referenceInsert = document.getElementById("geneCode" + i).innerHTML;
							var proteinInsert = document.getElementById("protein" + i).innerHTML;
							var summaryInsert = document.getElementById("summary" + i).innerHTML;
						
							//This code adds the gene save forms to the html document if a registered user is logged in. Unfortunatly, .innerHTML would not work across multiple lines.
							document.getElementById("save" + i).innerHTML = "<form action='saveGene.php' method='post'><input type='submit' class='btn' id='saveSubmit" + i + "' name='saveSubmit" + i + "' value='Save'><input type='hidden' name='organism' id='organism' value='" + organismInsert +"'><input type='hidden' name='taxonomy' id='taxonomy' value='" + taxonomyInsert +"'><input type='hidden' name='reference' id='reference' value='" + referenceInsert + "'><input type='hidden' name='protein' id='protein' value='" + proteinInsert + "'><input type='hidden' name='summary' id='summary' value='" + summaryInsert +"'></form>";
							
						}
						
						//Separate the gene info with an <hr> division
						document.getElementById("line" + i).innerHTML = "<hr>";
					}
					
				}
			};
				
				//Before the document is loaded, display a new loading message to update the user's progress
				document.getElementById('loadtext').innerHTML="Preparing your summary...";
				
				//Delay the request to please the NCBI
				setTimeout( function() {
				
				//Log the request that is made
				console.log(base + "esummary.fcgi?db=gene&id=" + id);
				
				//Direct the request and send it
				xmlHttp.open("GET", base + "esummary.fcgi?db=gene&id=" + id ,true);
				xmlHttp.send();
				},2000);
		}
		
		//This function handles saving of genes to an account holder's library.
		function handleSave(saveId) {
			/*The save ID values are always going to be at the later end of the string. So, we can make a substring to find the index of the
			clicked save button*/
			var index = saveId.substr(4,saveId.length);
			console.log(index);
		}
</script>

  <div class="jumbotron text-center">
    <h1>Gene Search</h1> 
    <p>A search will return a list of the top 20 genes related to your request.</p>
	<p>If you do not know where to begin, try searching for genes like TNF or TP53.</p>
	<p>You must be logged in to save a gene to your library.</p>
  </div>
  
<div class='container'>
	
	<div class='form-group'>
		<input class='col-sm-11 form-horizontal' type='text' id='searchvalue' placeholder='Search'>
		<button class='col-sm-1 btn-submit' onclick='getGeneXMLContent()'>Submit</button>
	</div>
	<div class='row'>
		<div class='col-md-12'>
			<p id='loadtext'></p>
		</div>
	</div>
	
</div>
<div class='container-fluid'>
	<div class='row'>
		<div id='geneHeader' class='col-md-2'>
		</div>
		<div id='proteinHeader' class='col-md-2'>
		</div>
		<div id='organismHeader' class='col-md-3'>
		</div>
		<div id='summaryHeader' class='col-md-4'>
		</div>
		<div id='saveHeader' class='col-md-1'>
		</div>
	</div>
	<hr>

</div>
<?php include('common/pageFooter.php'); ?>