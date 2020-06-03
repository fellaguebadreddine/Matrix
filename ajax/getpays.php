<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $id = intval($_GET['id']);
}

$cpt1 =0;
$Continents = Continent::trouve_id_and_name_CCI();
?>

                              
                                           
                                    <ul  class="detaildomaines" style="  list-style-type: none;   margin: 0;padding: 0;">
                                <?php foreach ($Continents as $Continent) { $cpt1++;  ?>    
                                  <li style="padding: 0px 0px;"  ><span class="continent <?php if ($cpt1 == 1) { echo'continent-down'; }?>"> <img style="margin-right: 6px;" src="assets/image/A-DjiantNetwork.svg" width="22px"> <?php echo $Continent->name; ?></span>

                                     <ul class="pays  <?php if ($cpt1 == 1) { echo'active'; }?>">
                                 <?php $Pays = Pays::trouve_par_continent_id_display($Continent->id); foreach ($Pays as $Pays){  $Server = Djiant_index::trouve_par_pays_network($Pays->id,$id);  ?>
                                      <li name ="<?php echo $Pays->name; ?>" value="<?php echo $id ?>" id="<?php if(isset($Pays->id)) {echo $Pays->id;} ?>"   class="pays-list"> <i class="fa fa-folder-o" style="font-size: 15px;margin-right: 3px;"></i> <?php echo $Pays->name; ?>  <span class="number"> <?php if(isset($Server->nbr)) {echo $Server->nbr;} else {echo '0';} ?></span></li>

                                      </li>  
                                      <?php } ?>
                                    </ul>
                                  </li>
                                <?php } 

                                 ?>
                                </ul>
<script>
  var continent = document.getElementsByClassName("continent");  
  var j;
  for (i = 0; i < continent.length; i++) {
  continent[i].addEventListener("click", function() {
    this.parentElement.querySelector(".pays").classList.toggle("active");
    this.classList.toggle("continent-down");
  });
}

</script>
                                    