<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $id = intval($_GET['id']);
}
if (isset($_GET['user_id'])) {
 $user_id = intval($_GET['user_id']);
}
if (isset($id)) {
   $Regions = Region::trouve_region_par_id_pays($id);

 
}

?>
                                        <select id='id_region' name="region"  placeholder="Région" style='font-size: small;'  class='form-control select2me input-sm'>
																
													<?php  foreach ($Regions as $Region) { echo "<option value = '".$Region->Region1."'>".$Region->Region1."</option>";}; ?>			
                                        </select>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#id_region').select2();
            });
            </script> 