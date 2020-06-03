<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $id = intval($_GET['id']);
}
if (isset($id)) {
   $Server = Server::trouve_par_id($id);
 
}

 if (isset($Server->id)) {
 	$Server->supprime();
 	$Djiant_index = Djiant_index::actualiser();
 echo '<script type="text/javascript">
			toastr.info("'. $Server->nom .' Supprimer avec succès","Très bien !");
			</script>';
 }else
 {
 echo '<script type="text/javascript">
			toastr.warning(" Serveur n\'existe pas ","Attention!");
			</script>';
 }

 ?>