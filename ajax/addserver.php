<?php
require_once("../includes/initialiser.php");


		$errors = array();
if (empty($_POST['site'])) {
	 $errors[]= 'Champ Site web est vide !';
}
if (!isset($_POST['statut'])) {
	 $errors[]= 'Champ Statut  est vide !';
}
if (!isset($_POST['authorized'])) {
	 $errors[]= 'Champ Publier  est vide !';
}
if (empty($_POST['reseaux'])) {
	 $errors[]= 'Choisir un reseau !';
}

	// new object Server
	$Server = new Server();
	$Server->id_DetailDomaine = htmlspecialchars(trim($_POST['reseaux']));
	$Server->nom = htmlspecialchars(trim($_POST['nom']));
	$Server->acronyme = htmlspecialchars(trim($_POST['acronyme']));
	$Server->pays = htmlspecialchars(trim($_POST['pays']));
	$Server->adr_line_1 = htmlspecialchars(trim($_POST['adr1']));
	$Server->adr_line_2 = htmlspecialchars(trim($_POST['adr2']));
	$Server->adr_line_3 = htmlspecialchars(trim($_POST['adr3']));
	$Server->ville = htmlspecialchars(trim($_POST['ville']));
	$Server->code_postal = htmlspecialchars(trim($_POST['code_postal']));
	$Server->url_server = htmlspecialchars(trim($_POST['site']));
	if (isset($_POST['longitude']) && isset($_POST['latitude'])) {
	$Server->longitude = htmlspecialchars(trim($_POST['longitude']));
	$Server->latitude = htmlspecialchars(trim($_POST['latitude']));
	}
	else{
	 $address =  htmlspecialchars(trim($_POST['gps'])) ;	
	 $latLong = getLatLong($address);
	 $Server->latitude = $latLong['latitude']?$latLong['latitude']:'0';
	 $Server->longitude = $latLong['longitude']?$latLong['longitude']:'0';
	}
	$Server->about = htmlspecialchars(trim($_POST['desc']));
	$Server->phone = htmlspecialchars(trim($_POST['phone']));
	if (isset($_POST['statut'])) {
	$Server->is_Djiant = htmlspecialchars(trim($_POST['statut']));
	}
	if (isset($_POST['authorized'])) {
	$Server->authorized = htmlspecialchars(trim($_POST['authorized']));
	}

	$Server->zoom = htmlspecialchars(trim($_POST['zoom']));
	$Server->region = htmlspecialchars(trim($_POST['region']));
	$Server->indicatif = htmlspecialchars(trim($_POST['indicatif']));
	$Server->created_at = mysql_datetime();
	$Server->created_by = htmlspecialchars(trim($_POST['user_id']));
   
	if (empty($errors)){
if ($Server->existe()) {
			echo '<script type="text/javascript">
			toastr.error("'. $Server->nom .' existe déja","Erreur !");
			</script>';
			
		}else{
			$Server->save();
			$Djiant_index = Djiant_index::actualiser();
			?>
 		<script type="text/javascript">
			toastr.success(" <?php echo $Server->nom ; ?> Ajouter avec succes","Très bien !");
			$(document).ready(function(){
				$('#formupdate input[type="text"]').val('');
				$('#formupdate input[type="radio"]').attr('checked', false);
				$('#formupdate #desc').val('');
			});
			</script>
<?php
 		 }
 		}else{
 					// errors occurred
        	         echo '<script type="text/javascript">
        	          toastr.error("';
        	         	 foreach ($errors as $msg) {
        	         	echo ' - '.$msg.' <br />';
        	         	 }
			echo '  ","Attention !");
			</script>'; 	  
	}
 ?>
