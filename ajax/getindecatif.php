<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $id = intval($_GET['id']);
}
if (isset($_GET['user_id'])) {
 $user_id = intval($_GET['user_id']);
}
if (isset($id)) {
   $Pays = Pays::trouve_par_id($id);

 
}

?>
                                        <input type="text"  name = "indicatif" class="form-control input-sm " placeholder="indicatif" value ="+<?php if (isset($Pays->tel_Indicatif)){ echo html_entity_decode($Pays->tel_Indicatif); } ?>" style="width: 117%;" >