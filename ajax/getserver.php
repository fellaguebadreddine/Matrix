<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $id = intval($_GET['id']);
}
if (isset($_GET['user_id'])) {
 $user_id = intval($_GET['user_id']);
}
if (isset($id)) {
   $Server = Server::trouve_par_id($id);

 
}
$longitude =0;
$latitude = 0;
   $domaines = Domaine::trouve_tous();
?>
                                        
                                                <form  id="formupdate"  class="form-horizontal" >
                                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Statut </label>
                                        <div class="col-md-5  checkbox-list" style="WIDTH: 36%;">
                                            <label class="checkbox-inline"> <img width="12px" src="assets/image/Marker-gris.svg" alt="">
                                           <input required="" type="radio"  class="icheck" data-radio="iradio_square-grey"value="0" <?php if (isset($Server->is_Djiant) && $Server->is_Djiant == 0 ) { echo 'checked';} ?> name="statut">  </label>
                                            <label class="checkbox-inline" > <img width="12px" src="assets/image/Marker-blue.svg" alt="" >
                                           <input required="" type="radio"  class="icheck" data-radio="iradio_square-grey"value="1" <?php if (isset($Server->is_Djiant) && $Server->is_Djiant == 1 ) { echo 'checked';} ?> name="statut"> </label>
                                            
                                        </div>
                                         <div class="col-md-4" style="WIDTH: 39%;">
                                          <select id="zoom" class="select2me form-control input-sm" name="zoom" data-placeholder="Zoom">
                                <option value="1" <?php  if ($Server->zoom == 1 ) { echo "selected";} ?>>Monde</option>
                                <option value="2" <?php  if ($Server->zoom == 2 ) { echo "selected";} ?>>Continent</option>
                                <option value="3" <?php  if ($Server->zoom == 3 ) { echo "selected";} ?>>Pays</option>
                                <option value="4" <?php  if ($Server->zoom == 4 ) { echo "selected";} ?>>Région</option>
                                <option value="5" <?php  if ($Server->zoom == 5 ) { echo "selected";} ?>>Ville</option>
                                <option value="6" <?php  if ($Server->zoom == 6 ) { echo "selected";} ?>>Local</option>
                                            </select>
                                            </div>
                                    </div>
                                        <div class="form-group">
                                                    <label class="col-md-3 control-label">Acronyme </label>
                                                    <div class="col-md-9">
                                                        <input type="text"  value ="<?php if (isset($Server->acronyme)){ echo html_entity_decode($Server->acronyme); } ?>"  name ="acronyme" class="form-control input-sm " placeholder="">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Nom complet </label>
                                                    <div class="col-md-9">
                                                        <input type="text" value ="<?php if (isset($Server->nom)){ echo html_entity_decode($Server->nom); } ?>" name = "nom" class="form-control input-sm" placeholder="">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Site web </label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                            <input type="text" id="site_web" value ="<?php if (isset($Server->url_server)){ echo html_entity_decode($Server->url_server); } ?>" name="site" class="form-control input-sm">
                                            <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" onClick="GetURL()" type="button"><i class="fa fa-external-link" aria-hidden="true"></i></button>
                                            </span>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">GPS </label>
                                                    <div class="col-md-9">
                                                       <div class="input-group">
                                            <input type="text" name="gps" id="gps" class="form-control input-sm">
                                            <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" id ="get_latlong" data-target="#static" data-toggle="modal" type="button"><i class="fa fa-external-link"  aria-hidden="true"></i></button>
                                            </span>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row form-group" id="locations">
                                       <label class="col-md-3 control-label text-left">Lat</label>
                                            <div class="col-md-4">
                                                <input name="lat" type="text" class="form-control input-sm" value ="<?php if (isset($Server->latitude)){ echo html_entity_decode($Server->latitude); } ?>" required>
                                            </div>
                                            <label class="col-md-2 control-label text-left" style="width: 11%;">Long</label>
                                            <div class="col-md-3" style="width: 30%;">
                                                <input name="long" type="text"    class="form-control input-sm" value ="<?php if (isset($Server->longitude)){ echo html_entity_decode($Server->longitude); } ?>" required="">
                                            </div>
                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Réseaux </label>
                                                    <div class="col-md-9">
                                                      <select  name="reseaux" class="form-control input-sm select2me" >
                                                        <?php
                                                       foreach ($domaines as $domaine) { echo "<optgroup label='".$domaine->lib_Domaine."'>"; $detaildomaines = Detaildomaine::trouve_par_domaine($domaine->id); foreach ($detaildomaines as $detaildomaine) {?> <option  value = " <?php echo $detaildomaine->id ; ?> " <?php  if ($Server->id_DetailDomaine == $detaildomaine->id ) { echo "selected";} ?> > <?php echo $detaildomaine->lib_DetailDomaine; ?> </option>  <?php  } ?>    </optgroup><?php } ?> </select>
                                                    </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                   <label class="col-md-3 control-label text-left">Pays</label>
                                            <div class="col-md-9">
                                                 <select id='pays_list' name="pays"   style='font-size: small;'  class='form-control select2me input-sm'><?php $pays = Pays::trouve_tous();  foreach ($pays as $pays) {?> <option value = "<?php echo $pays->id ; ?> " <?php  if ($Server->pays == $pays->id ) { echo "selected";} ?> ><?php echo $pays->name; ?></option> <?php } ?></select>
                                            </div>
                                                    
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label text-left">Region</label>
                                                     <div class="col-md-9 region">
                                                        <select id='id_region' name="region"  placeholder="Région" style='font-size: small;'  class='form-control select2me input-sm'>
                                                               <?php $Regions = Region::trouve_region_par_id_pays($Server->pays);  foreach ($Regions as $Region) {?> <option value = "<?php echo $Region->Region1 ; ?> " <?php  if ($Server->region == $Region->Region1 ) { echo "selected";} ?> ><?php echo $Region->Region1; ?></option> <?php } ?>
                                                        </select>
                                                       
                                                    </div>
                                                </div>
                                                    <div class="row form-group">
                                       <label class="col-md-3 control-label text-left">Ville</label>
                                            <div class="col-md-5">
                                                <input name="ville" type="text" class="form-control input-sm" value ="<?php if (isset($Server->ville)){ echo html_entity_decode($Server->ville); } ?>" required>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <input name="code_postal"  type="text" placeholder="Code Post"   class="form-control input-sm" name="code_postal" value ="<?php if (isset($Server->code_postal)){ echo html_entity_decode($Server->code_postal); } ?>" required="">
                                            </div>
                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Adress line 1 </label>
                                                    <div class="col-md-9">
                                                        <input type="text" value ="<?php if (isset($Server->adr_line_1)){ echo html_entity_decode($Server->adr_line_1); } ?>" name = "adr1" class="form-control input-sm " placeholder="">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Adress line 2 </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name = "adr2" class="form-control input-sm "  value ="<?php if (isset($Server->adr_line_2)){ echo html_entity_decode($Server->adr_line_2); } ?>"placeholder="">
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Adress line 3 </label>
                                                    <div class="col-md-9">
                                                        <input type="text" value ="<?php if (isset($Server->adr_line_3)){ echo html_entity_decode($Server->adr_line_3); } ?>" name = "adr3" class="form-control input-sm " placeholder="">
                                                    </div>
                                                    </div>
                                                    
                                   
                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Phone </label>
                                                    <div class="col-md-2 indicatif">
                                                        <input type="text"  name = "indicatif" class="form-control input-sm " placeholder="indicatif" value ="<?php if (!empty($Server->indicatif)){ echo html_entity_decode($Server->indicatif); }else{$pays = Pays::trouve_par_id($Server->pays); echo '+'.$pays->tel_Indicatif; } ?>" style="width: 117%;" >
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" name = "phone" class="form-control input-sm " placeholder="phone" value ="<?php if (isset($Server->phone)){ echo html_entity_decode($Server->phone); } ?>">
                                                    </div>
                                                    
                                                       
                                                    
                                    </div>
                                    <br>
                                    <div class="  form-group">
                                        <label class="col-md-3 control-label">Description </label>
                                        <div class="col-md-9">
                                                        <textarea name="desc" id="desc" class="form-control" rows="12"> <?php if (isset($Server->about)){ echo html_entity_decode($Server->about); } ?></textarea>
                                                    </div>
                                    </div>
                                    <input type="hidden" name="id" id="id_srv" value="<?php if (isset($Server->id)) { echo$Server->id; }  ?>" />
                                    <input type="hidden" name="user_id"  value="<?php if (isset($user_id)) { echo$user_id; }  ?>" />
                                    
                                        
                                        <label class=" col-md-3 control-label" style="padding-right: 15px;">Publier </label>
                                        <div class="col-md-4 checkbox-list "  >
                                            <label class="checkbox-inline"  > <i class="fa fa-check-circle" style="color: #359d22;font-size: 18px; vertical-align: sub;"></i>
                                           <input required="" type="radio" class="icheck"  value="1" <?php if (isset($Server->authorized) && $Server->authorized == 1 ) { echo 'checked';} ?> name="authorized">  </label>
                                            <label class="checkbox-inline"  > <i class="fa fa-times-circle" style="color: #df0048;font-size: 18px; vertical-align: sub;"></i>
                                           <input required="" type="radio" class="icheck"  value="0" <?php if (isset($Server->authorized) && $Server->authorized == 0 ) { echo 'checked';} ?> name="authorized"> </label>
                                            
                                        </div>   
                                         
                                        </form>
                                                <div class="col-md-5"   >
                                                     <button  name="delete" id="delete"  style="   border-radius: 4px !important;" class=" btn dark btn-sm " data-target="#static2" data-toggle="modal"><i class="fa fa-trash-o"></i></button>
                                                        <button  id="update" style=" float: right;  background-color: black;color: #ffffff;border-radius: 4px !important;" class="btn btn-sm"><i class="fa fa-save"></i> Enregistrer</button>
                                                        <button  id="add" style=" float: right; background-color: black;color: #ffffff;border-radius: 4px !important; display: none;" class="btn btn-sm"><i class="fa fa-save"></i> Enregistrer</button>
                                                       
                                                        
                                                </div>
                                        
                            <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-header modalheader">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                                    <h3 class="modal-title modaltitle" ></h3>
                                </div>
                                <div class="modal-body modalbody">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn default">Annuler</button>
                                    <button type="button" data-dismiss="modal" id="get_latlongmodal" class="btn blue">Continuer </button>
                                </div>
                            </div>  
                            <div id="static2" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                                    
                                </div>
                                <div class="modal-body">
                                    Would you like to continue delete <?php if (isset($Server->nom)) { echo$Server->nom; } ?> 
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="button" data-dismiss="modal" class="btn default">Annuler</button>
                                    <button type="button" data-dismiss="modal" id="delete_srv" class="btn blue">Continuer </button>
                                </div>
                            </div>  
                                                 
                                                 

        <script type="text/javascript">
            $(document).ready(function(){
                $('.select2me').select2();
                $('.icheck').iCheck({
                radioClass: 'iradio_minimal-grey' 
                });
                $("#zoom").select2({
                minimumResultsForSearch: -1
                });
            });
            </script>                                            
                       

											 