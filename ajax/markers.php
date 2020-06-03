<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id_pays'])) {
 $id_pays = intval($_GET['id_pays']);
}
if (isset($_GET['id_network'])) {
 $id_network = intval($_GET['id_network']);
}
if (isset($id_network)&& isset($id_pays)) {
   $Servers = Server::trouve_markers_par_pays_network($id_pays,$id_network);
                                foreach ($Servers as  $Server) { ?>       
                                <div class="row" id="<?php echo $Server->id; ?>" >
                                    <div class="col-md-1" style="width: 1%; margin-top: 4px; margin-left: 7px;">
                                        <img width="11px" style="vertical-align: top;" src="assets/image/<?php if($Server->is_Djiant == 1) { echo 'Marker-blue.svg' ;} else { echo 'Marker-gris.svg';} ?>" alt="<?php if (isset($Server->nom )) { echo $Server->nom;} ?>"> 
                                    </div>
                                    <div class="col-md-9"  style="width: 92%;">
                                        <a  href="javascript:;"  id="<?php if (isset($Server->id )) { echo $Server->id;} ?>"  class="list-group-item ">
                                 <?php if (isset($Server->nom )) {  echo count_lenght_and_show($Server->nom); } ?> <span class="number"> <?php  if ( $Server->authorized ==1 ) { echo '<i class="fa fa-check-square-o " ></i>';} ?>   </span></a>
                                     </div>
                                </div>

                        <?php }} ?>

                                             
                       

											