<?php
require_once("includes/initialiser.php");
if(!$session->is_logged_in()) {

	readresser_a("login.php");

}else{
	$user = Accounts::trouve_par_id($session->id_utilisateur);
	if (empty($user)) {
	$user = Client::trouve_par_id($session->id_utilisateur);
	}
	$accestype = array('administrateur','utilisateur');
	if( !in_array($user->type,$accestype)){ 
		//contenir_composition_template('simple_header.php'); 
		$msg_system ="vous n'avez pas le droit d'accéder a cette page <br/><img src='../images/AccessDenied.jpg' alt='Angry face' />";
		echo system_message($msg_system);
		// contenir_composition_template('simple_footer.php');
		exit();
	} 
}
?>
<?php
$titre = "Djiant  Matrix V2.0";
if ($user->type =='administrateur' or $user->type =='utilisateur'){
	require_once("header/header.php");
	require_once("header/navbar.php");
}elseif ($user->type =='Admin_perso' or 'Agent_perso' or 'Admin_bg' or 'Agent_bg' ){
	//require_once("header/header_see.php");
	readresser_a("index1.php");
}
else {
	readresser_a("profile_utils.php");
	 $personnes = Accounts::not_admin();
}
?>


	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">

			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->

			<!-- END PAGE HEADER-->
				<?php if ($user->type == 'administrateur') { 





				   ?>
			<!-- BEGIN DASHBOARD STATS -->


				<div class="row">
					<div class="col-md-3 " style="  padding-right: 0px; padding-left: 5px;">
						<div class="portlet light ">
							<div class="portlet-title">
								<div style="" class="caption note">
								 Markers 
								</div>
							
							</div>
							<div class="portlet-body ">
							
							<div class="list-group scrollable markers" style="height: 800px; padding-right: 0px" >
								
								
							</div>	
							
							</div>
						</div>
					</div>
					<div class="col-md-3 " style=" padding-left: 0px;">
						<div class="portlet light " style="padding-left: 0px;">
							<div class="portlet-title">
								<div style="" class="caption note">
								 Détails 

								</div>
							<div class="col-md-2">
										<button  id="reset" class="btn  btn-default btn-sm">
								<i class="glyphicon glyphicon-map-marker" style="font-size: 16px;margin: -3px;"></i>  
								<i class="fa fa-plus" style="font-size: 10px;"></i>
								</button>
									</div>
							</div>
							<div class="portlet-body ">
									<div class="notification"></div>
										<div id="serverform">
												<form  id="formupdate"  class="form-horizontal" >
													<div class="form-group">
										<label class="col-md-3 control-label">Statut </label>
										<div class="col-md-5  checkbox-list" style="WIDTH: 36%;">
											<label class="checkbox-inline"> <img width="12px" src="assets/image/Marker-gris.svg" alt="" >
											<input required type="radio" class="icheck" data-radio="iradio_minimal-grey" value="0" name="statut" >  </label>
											<label class="checkbox-inline"> <img width="12px" src="assets/image/Marker-blue.svg" alt="" >
											<input required type="radio" class="icheck" data-radio="iradio_minimal-grey" value="1" name="statut"> </label>
											
										</div>
										 <div class="col-md-4" style="WIDTH: 39%;">
                                                <select class="select2me form-control input-sm" id="zoom" name="zoom" data-placeholder="Zoom">
												<option value="1">Monde</option>
												<option value="2">Continent</option>
												<option value="3">Pays</option>
												<option value="4">Région</option>
												<option value="5">Ville</option>
												<option value="6">Local</option>
											</select>
                                            </div>
									</div>
                         				<div class="form-group">
                                                    <label class="col-md-3 control-label">Acronyme </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name = "acronyme" class="form-control input-sm " placeholder="">
                                                    </div>
                                                	</div>
                                                	<div class="form-group">
                                                    <label class="col-md-3 control-label">Nom complet </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name = "nom" class="form-control input-sm" placeholder="">
                                                    </div>
                                                	</div>
                                                	<div class="form-group">
                                                    <label class="col-md-3 control-label">Site web </label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
											<input type="text" id="site_web" name="site" class="form-control input-sm">
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
                                                	<div class="form-group">
                                                    <label class="col-md-3 control-label">Réseaux </label>
                                                    <div class="col-md-9">
                                                      <select placeholder=" " name="reseaux" class="select2me form-control input-sm "  >
                                                      	<option value=""></option>
                                                      	<?php
                                                       foreach ($domaines as $domaine) { echo "<optgroup label='".$domaine->lib_Domaine."'>"; $detaildomaines = Detaildomaine::trouve_par_domaine($domaine->id); foreach ($detaildomaines as $detaildomaine) { echo "<option value = '".$detaildomaine->id."'>".$detaildomaine->lib_DetailDomaine."</option>";}    echo "</optgroup>"; } ?> </select>
                                                    </div>
                                                	</div>
   													<br>
   													<div class="form-group">
                                                   <label class="col-md-3 control-label text-left">Pays</label>
                                            <div class="col-md-9">
                                                <select id='pays_list' name="pays"  style='font-size: small;'  class='form-control select2me input-sm'>
																<option value=""></option>
                                                	<?php $pays = Pays::trouve_tous();  foreach ($pays as $pays) { echo "<option value = '".$pays->id."'>".$pays->name."</option>";}; ?></select>
                                            </div>
                                                   
                                    				</div>
													<div class="form-group">
														<label class="col-md-3 control-label text-left">Region</label>
                                    				 <div class="col-md-9 region">
                                                    	<select id='id_region' name="region"  placeholder="Région" style='font-size: small;'  class='form-control select2me input-sm'>
																<option value=""></option>
                                                		</select>
                                                       
                                                    </div>
                                                </div>
                                    				<div class="row form-group">
                                       <label class="col-md-3 control-label text-left">Ville</label>
                                            <div class="col-md-5">
                                                <input name="ville" type="text" class="form-control input-sm" value="" required>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <input name="code_postal" type="text" placeholder="Code Post"   class="form-control input-sm" value="" required="">
                                            </div>
                                    </div>
                                                	<div class="form-group">
                                                    <label class="col-md-3 control-label">Adress line 1 </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name = "adr1" class="form-control input-sm " placeholder="">
                                                    </div>
                                                	</div>
                                                	<div class="form-group">
                                                    <label class="col-md-3 control-label">Adress line 2 </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name = "adr2" class="form-control input-sm " placeholder="">
                                                    </div>
                                                	</div>
                                                	<div class="form-group">
                                                    <label class="col-md-3 control-label">Adress line 3 </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name = "adr3" class="form-control input-sm " placeholder="">
                                                    </div>
                                                	</div>
                                                	
                                    
                                    <div class="form-group">
                                                    <label class="col-md-3 control-label">Phone </label>
                                                     <div class="col-md-2 indicatif">
                                                        <input type="text"  name = "indicatif" class="form-control input-sm " placeholder="" >
                                                    </div>
                                                    <div class="col-md-7">
                                                        <input type="text" name = "phone" class="form-control input-sm " placeholder="">
                                                    </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
										<label class="col-md-3 control-label">Description </label>
										<div class="col-md-9">
                                                        <textarea name="desc" id="desc" class="form-control" rows="12"></textarea>
                                                    </div>
									</div>
									<input type="hidden" name="user_id"  value="<?php if (isset($user_id)) { echo$user_id; }  ?>" />
									<label class=" col-md-3 control-label" style="padding-right: 15px;">Publier </label>
                                        <div class="col-md-4  checkbox-list"  style="padding-top: 5px;">
                                            <label class="checkbox-inline"  > <i class="fa fa-check-circle" style="color: #359d22;font-size: 18px; vertical-align: sub;"></i>
                                           <input required="" type="radio" class="icheck" data-radio="iradio_minimal-grey" value="1"  name="authorized">  </label>
                                            <label class="checkbox-inline"  > <i class="fa fa-times-circle" style="color: #df0048;font-size: 18px; vertical-align: sub;" ></i>
                                           <input required="" type="radio" class="icheck" data-radio="iradio_minimal-grey" value="0"  name="authorized"> </label>
                                            
                                        </div>    
                                    	</form>				
                                    			<div class="col-md-5"   >
														<button  id="add" style=" float: right; background-color: black;color: #ffffff;border-radius: 4px !important;" class="btn btn-sm"><i class="fa fa-save"></i> Enregistrer</button>
														
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
	
										</div>
                                
                                
                            
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="tabbable-line " style="padding-left: 4px;">
								<ul class="nav nav-tabs ">
									<li class="active ">
										<a href="#tab_1" data-toggle="tab">
										Site web </a>
									</li>
									<li>
										<a href="#tab_2" data-toggle="tab">
										Map </a>
									</li>
									<li class="disabled">
										<a href="#tab_3"  >
										CRM </a>
									</li>
									<li class="disabled">
										<a href="#tab_4"  >
										Serveur </a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										
									</div>
									<div class="tab-pane" id="tab_2">
										
									</div>
									<div class="tab-pane" id="tab_3">
										
									</div>
									<div class="tab-pane" id="tab_4">
										
									</div>
								</div>
							</div>
					</div>
					
				</div>

			<?php } ?>
		
								
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>


		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		2020 &copy; Djinat.com ® All rights reserved
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="assets/global/plugins/icheck/icheck.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/global/scripts/toastr.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/components-dropdowns.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
	$(document).on('click','#get_latlong', function() {
   var id = $('#gps').val(); 
       id = id.replace(/\s+/g, '+').toLowerCase();    
  //this is just getting the value that is selected
    var title = $("#gps" ).val();
  $('.modaltitle').html('Géolocalisation de '+title);
 $('.modalbody').load('ajax/GetModelContent.php?id='+id,function(){       
    });
});


</script>
<script>
	$(document).on('click','#get_latlongmodal', function() {
   var id = $('#gps').val(); 
       id = id.replace(/\s+/g, '+').toLowerCase();    
  //this is just getting the value that is selected
 $('#locations').load('ajax/Getlocations.php?id='+id,function(){       
    });
});
</script>
<script>
	$(document).on('click','#delete_srv', function() {
   var id = $('#id_srv').val();   
  //this is just getting the value that is selected
 $('.notification').load('ajax/delete_srv.php?id='+id,function(){       
    });
 	$('div#'+id).hide();
    $('button#update').hide();
    $('button#add').show(); 
	$('#formupdate input[type="text"]').val('');
	$('.icheck').iCheck('uncheck');
	$('#formupdate #desc').val('');
    $('#map').empty();
    $('#locations').empty();
});
</script>

</script>               
<script>
$(document).on('click','button#update', function() {
$.ajax({
type: "POST",
url: "ajax/updateserver.php",
data: $('#formupdate').serialize(),
success: function(message){
$(".notification").html(message)
},
error: function(){
alert("Error");
}
});
});


$(document).on('click','button#add', function() {
$.ajax({
type: "POST",
url: "ajax/addserver.php",
data: $('#formupdate').serialize(),
success: function(message){
	$(".notification").html(message)

},
error: function(){
alert("Error");
}
});
});

    $(document).on("click","a.list-group-item",function(){
   var id = $(this).attr('id');
    $('a.list-group-item').removeClass('selected');
    $(this).addClass('selected'); 
   var user_id = <?php echo $user->id ; ?> ;
 $('#serverform').load('ajax/getserver.php?id='+id+'&user_id='+user_id,function(){       
    });
 $('.tabbable-line').load('ajax/getTabContent.php?id='+id+'&user_id='+user_id,function(){       
    });
});
</script>

<script>

jQuery(document).ready(function() {    
	
    ComponentsDropdowns.init();
    Metronic.initAjax();
       Layout.init(); // init current layout
    $("#zoom").select2({
                minimumResultsForSearch: -1
                });
});
</script>

<script type="text/javascript" language="javascript">
<!--
function GetURL()
{
var URL =  document.getElementById("site_web").value;	
parent.open(URL);
}
-->
</script>
<script type="text/javascript"> 

    var $network = $('.network li').on('click', function(e) {
    $network.removeClass('selected');
    $(this).addClass('selected');
    var id= $(this).attr('value');
    $('ul#Pays').hide();
    $('#delete').hide();
    $('button#update').hide();
    $('button#add').show(); 
    $( ".markers" ).empty();
	$('#formupdate input[type="text"]').val('');
	$('.icheck').iCheck('uncheck');
	$('#formupdate #desc').val('');
    $('#map').empty();
    $('#locations').empty();
    $('#domaine_name').empty();
    $( "#domaine_name" ).append( $(this).attr('id') );
    $( "#domaine_name" ).show(); 
        $('.list_pays').load('ajax/getpays.php?id='+id,function(){       
    });

    
}); 
    $(document).on('click','.pays li', function() {
    $('.pays-list').removeClass('selected');
    $(this).addClass('selected');
    var id_pays= $(this).attr('id');
    var id_network = this.value;
    $('.markers').load('ajax/markers.php?id_pays='+id_pays+'&id_network='+id_network,function(){       
    });
    $('#formupdate input[type="text"]').val('');
	$('.icheck').iCheck('uncheck');
	$('#formupdate #desc').val('');
    $('#map').empty();
    $('#delete').hide();
    $('button#update').hide();
    $('.mega-menu-dropdown').removeClass('open');
    $('button#add').show(); 
    $('#locations').empty();
    $('#pays_name').empty();
    var pays_name = $( "#pays_name:first" ).text();
    $( "#pays_name" ).append( $(this).attr('name') );
    $( "#pays_name" ).show(); 
    
});
</script>
<script>
	$(document).on('change','#pays_list', function() {
	 var id = this.value;
	 $('.indicatif').load('ajax/getindecatif.php?id='+id,function(){       
    });
	 $('.region').load('ajax/getregion.php?id='+id,function(){       
    });
});

 
</script>
<script>
$(document).ready(function(){
    $(document).on('click','#reset', function() {
	$('#formupdate input[type="text"]').val('');
	$('.icheck').iCheck('uncheck');
	$('#formupdate #desc').val('');
	$('#delete').hide();
	$('button#update').hide();
    $('button#add').show(); 
    $('#map').empty();
    $('#locations').empty();
    $("option:selected").removeAttr("selected");
    });
});
</script>
<script>
var domaine = document.getElementsByClassName("domaine");
var i;
for (i = 0; i < domaine.length; i++) {
  domaine[i].addEventListener("click", function() {
    this.parentElement.querySelector(".network").classList.toggle("active");
    this.classList.toggle("domaine-down");
  });
}


</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>