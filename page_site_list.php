<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php include("includes/head.php"); ?>

<title>List of X3 orders</title>
</head>
<body role="document">
    <?php include("includes/menu_home.php"); ?>
	
<header>
		<div class="container">
			<div class="intro-text">
				<div class="intro-heading">List of X3 site</div>
				<div class="intro-lead-in">Simulates the left list of X3 orders</div>

			</div>

		</div>
	</header>

	<div class="container">

		<div class="bs-component">
			<div class="row">
				<div class="col-lg-12 col-md-7 col-sm-5 pt-5">
					<br>
					<label for="sites" class="pt-5"> List des Sites : </label>

						<?php
							require_once ('WebService/models/Site.php');
							try {
								$sites = new Site ();
									echo ($sites->showSiteListe ());
								} catch ( SoapFault $e ) {
									//echo var_dump($e);
									//echo "ol50".$e;
									ToolsWS::printError ( "X3 Web service not available" );
								}
						?>
							
						<label for="four" class="pt-5"> List des Fournisseurs : </label>

						<?php
							require_once ('WebService/models/Fournisseur.php');
							try {
								$fournisseurs = new Four ();
									echo ($fournisseurs->showFourList ());
								} catch ( SoapFault $e ) {

									ToolsWS::printError ( "X3 Web service not available" );
								}
						?>
						
						<label for="command" class="pt-5"> List des Commands : </label>
						<?php
							require_once ('WebService/models/Command.php');
							try {
								$Commands = new Command ();
									$LIN = $Commands->showList();
									echo "<table class='table table-striped table-bordered table-condensed'><thead><tr> <th>Date de Commande </th> <th>Numero de Commande</th> <th>Site</th> <th>Client</th> </tr></thead><tbody>";
									foreach($LIN as $L){
										echo "<tr>";
										foreach($L as $FLD){

											foreach($FLD as $data){
												for ($i=0; $i < 3; $i++) { 
													echo "<td>";
													print_r($data[$i]);
												echo '</td>';
												}
												
											}
										echo "</tr>";
										}
										
									}
									echo "</tbody></table>";

								} catch ( SoapFault $e ) {

									ToolsWS::printError ( "X3 Web service not available" );
								}
						?>

				</div>
				
			</div>
		</div>
	</div>
	
	<?php include("includes/end_body.php"); ?>
	<script type="text/javascript">
      // c'est ici que l'on va tester jQuery
      $(function(){
  // On peut accéder aux éléments.
  // $('#balise') marche.
  		set_icon_connect();var isConnect = '<?PHP echo $isConnect;?>';
  	    set_icon_connect(isConnect);
  
    	  
    	 
});

    </script>

</body>
</html>
