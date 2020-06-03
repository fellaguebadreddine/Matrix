<?php
require_once("../includes/initialiser.php");
if (isset($_POST['id'])) {
 $id = intval($_POST['id']);
}
if (isset($id)) {
   $Server = Server::trouve_par_id($id);
 
}
    $errors = array();
if (empty($_POST['site'])) {
	 $errors[]= 'Champ Site web est vide !';
}

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
	$Server->longitude = htmlspecialchars(trim($_POST['long']));
	$Server->latitude = htmlspecialchars(trim($_POST['lat']));
	$Server->about = htmlspecialchars(trim($_POST['desc']));
	$Server->phone = htmlspecialchars(trim($_POST['phone']));
	$Server->is_Djiant = htmlspecialchars(trim($_POST['statut']));
	$Server->authorized = htmlspecialchars(trim($_POST['authorized']));
	$Server->indicatif = htmlspecialchars(trim($_POST['indicatif']));
	$Server->zoom = htmlspecialchars(trim($_POST['zoom']));
	$Server->region = htmlspecialchars(trim($_POST['region']));
    if (empty($errors)){
        if ( $Server->save()) {
             		echo '<script type="text/javascript">
			toastr.success("'. $Server->nom .'  modifier avec succès ","Très bien !");
			</script>';
 		 	$Server->updated_at = mysql_datetime();
			$Server->updated_by = htmlspecialchars(trim($_POST['user_id']));
			$Server->save();
			$Djiant_index = Djiant_index::actualiser();
            
        }else{
                
         echo '<script type="text/javascript">
			toastr.info(" S\'il vous plaît modifier à nouveau  ","Aucun changement !");
			</script>';
        
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