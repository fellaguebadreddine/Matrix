<?php
require_once("includes/initialiser.php");
if(!$session->is_logged_in()) {

	readresser_a("login.php");

}else{
	$user = Accounts::trouve_par_id($session->id_utilisateur);
	
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
$titre = "RESEAUX ";
if ($user->type == "administrateur"){
$active_menu = "reseaux";
	if (isset($_GET['action']) && $_GET['action'] =='add' ) {
$active_submenu = "add";
$action = 'add';
	}else if (isset($_GET['action']) && $_GET['action'] =='list_reseaux' ) {
$active_submenu = "list_reseaux";
$action = 'list_reseaux';}
else if (isset($_GET['action']) && $_GET['action'] =='edit' ) {
$active_submenu = "list_reseaux";
$action = 'edit';}
else if (isset($_GET['action']) && $_GET['action'] =='add_ach' ) {
$active_submenu = "add_ach";
$action = 'add_ach';}
}

$header = array('table');
if ($user->type =='administrateur'){
	require_once("header/header.php");
	require_once("header/navbar.php");
}elseif ($user->type =='Admin_perso' or 'Agent_perso' or 'Admin_bg' or 'Agent_bg' ){
	//require_once("header/header_see.php");
	readresser_a("index1.php");
}
else {
	readresser_a("profile_utils.php");
	 $personnes = Personne::not_admin();
}

	if(isset($_POST['submit']) && $action == 'add'){
	$errors = array();
		// new object agence
	
	// new object document
	$Domaine = new Domaine();
	$Domaine->lib_Domaine = htmlentities(trim($_POST['lib_Domaine']));

	if (empty($errors)){
   		if ($Domaine->existe()) {
			$msg_error = '<p>  Réseau   ' . $Domaine->lib_Domaine . ' existe Déja !! </p>';
			
		}else{
			
			$Domaine->save();
 		$msg_positif = '<p >    Réseau    ' . $Domaine->lib_Domaine .  '  ajouté avec succès  </p>';
		
		}
 		 
 		}else{
		// errors occurred
		$msg_error = '<h1>  ERREUR  !! </h1>';
	    foreach ($errors as $msg) { // Print each error.
	    	$msg_error .= " - $msg<br />\n";
	    }
	    $msg_error .= '</p>';	  
	}
}



	if($action == 'edit' ){
	if ( isset($_GET['id'])  ) { 
 	$id = decrypt_url($_GET['id']) ; 
	$Domaine = Domaine:: trouve_par_id($id);

	 } elseif ( isset($_POST['id']) ) { 
		 $id = decrypt_url($_POST['id']) ;
	$Domaine = Domaine:: trouve_par_id($id);
	 } else { 
			$msg_error = '<p class="error">Cette page a été consultée par erreur</p>';
		} 
	if (isset($_POST['submit'])) {

	$errors = array();
		// new object agence
	
	// new object admin agence
	$Domaine->des_pro = htmlentities(trim($_POST['des_pro']));
	$Domaine->cat_pro = htmlentities(trim($_POST['cat_pro']));
	$Domaine->date_ent = htmlentities(trim($_POST['date_ent']));
	$Domaine->quant_min = htmlentities(trim($_POST['quant_min']));
	$Domaine->detail = htmlentities(trim($_POST['detail']));


	
	$Domaine->nb_piece = htmlentities(trim($_POST['nb_piece']));
	$Domaine->prix_acht = htmlentities(trim($_POST['prix_acht']));
	
	$msg_positif= '';
 	$msg_system= '';
	if (empty($errors)){
					

 		if ($Domaine->save()){
		$msg_positif .= '<p >  la modification été bien effectuée </p><br />';
														
														
		}else{
		$msg_system .= "<h1>Une erreur dans le programme ! </h1>
                   <p  >  S'il vous plaît modifier à nouveau !!</p>";
		}
 		
 		}else{
		// errors occurred
		$msg_error = '<h1>erreur!</h1>';
	    foreach ($errors as $msg) { // Print each error.
	    	$msg_error .= " - $msg<br />\n";
	    }
	    $msg_error .= '</p>';	  
		}
}		
	}

	if(isset($_POST['ajouter']) && $action == 'add_ach'){
	$errors = array();
		// new object achat

	$id = htmlentities(trim($_POST['id_pro']));
	$qant_achat = htmlentities(trim($_POST['qant_achat']));

	
	// new object document
	
	if ( isset($id)) { 
	$Domaines = Domaine:: trouve_par_id($id);

	
	 } else { 
			$msg_error = '<p class="error">Cette page a été consultée par erreur</p>';
		} 
$nb_piece = $Domaines->nb_piece + $qant_achat;	
$Domaines->nb_piece = $nb_piece;
$Domaines->prix_acht = htmlentities(trim($_POST['prix_unitair']));

	$msg_positif= '';
 	$msg_system= '';
	if (empty($errors)){
					

 		if ($Domaines->save()){
		$msg_positif .= '<p >  la modification été bien effectuée </p><br />';
														
														
		}else{
		$msg_system .= "<h1>Une erreur dans le programme ! </h1>
                   <p  >  S'il vous plaît modifier à nouveau !!</p>";
		}
 		}else{
		// errors occurred
		$msg_error = '<h1>erreur!</h1>';
	    foreach ($errors as $msg) { // Print each error.
	    	$msg_error .= " - $msg<br />\n";
	    }
	    $msg_error .= '</p>';	  
		}
	
}
?>


	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">

			<!-- BEGIN PAGE HEADER-->
			
			<!-- END PAGE HEADER-->
<?php if ($user->type == 'administrateur') {  

						if ($action == 'add') {		
				  ?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12">
<?php 
										if (!empty($msg_error)){
											echo error_message($msg_error); 
										}elseif(!empty($msg_positif)){ 
											echo positif_message($msg_positif);	
										}elseif(!empty($msg_system)){ 
											echo system_message($msg_system);
										} ?>


                    <div class="portlet light ">
						<div class="portlet-title">
							<div class="caption note">
								 Ajouter Réseau 
							</div>
							
						</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="<?php echo $_SERVER['PHP_SELF']?>?action=add" method="POST" class="form-horizontal" enctype="multipart/form-data">
											<div class="form-body">
												<br/>
												<br/>
												<div class="form-group">
													<label class="col-md-3 control-label">Réseau <span class="required" aria-required="true">
										* </span></label>
													<div class="col-md-6">
														<input type="text" name = "lib_Domaine" class="form-control " required>
													</div>
												</div>												
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" name = "submit" class="btn green">Ajouter</button>
														<button type="reset" class="btn  default">Annuler</button>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>

<?php }  elseif ($action == 'edit') { ?>
	<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12">
<?php 
										if (!empty($msg_error)){
											echo error_message($msg_error); 
										}elseif(!empty($msg_positif)){ 
											echo positif_message($msg_positif);	
										}elseif(!empty($msg_system)){ 
											echo system_message($msg_system);
										} ?>


                                <div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-magnifier"></i>Editer Domaine
										</div>

									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="<?php echo $_SERVER['PHP_SELF']?>?action=edit" method="POST" class="form-horizontal" enctype="multipart/form-data">
											<div class="form-body">

									<div class="form-group">
											<label class="col-md-3 control-label">Réseau <span class="required" aria-required="true">* </span></label>
													<div class="col-md-6">
														<input type="text"  value ="<?php if (isset($produit->des_pro)){ echo html_entity_decode($produit->des_pro); } ?>" name = "lib_Domaine" class="form-control " required>
													</div>
									</div>	
																									
												
											
												
												
										
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" name = "submit" class="btn green">Modifier</button>
														<button type="button" value="back" onclick="history.go(-1)" class="btn  default">Annuler</button>
														 <?php echo '<input type="hidden" name="id" value="' .encrypt_url($id) . '" />';?>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>

<?php	}elseif ($action == 'add_ach') {		
				  ?>

			<!-- BEGIN PAGE CONTENT-->
			<div class="row profile">
				<div class="col-md-12">
<?php 
										if (!empty($msg_error)){
											echo error_message($msg_error); 
										}elseif(!empty($msg_positif)){ 
											echo positif_message($msg_positif);	
										}elseif(!empty($msg_system)){ 
											echo system_message($msg_system);
										} ?>


                                <div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-magnifier"></i>Ajouter achat
										</div>

									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="<?php echo $_SERVER['PHP_SELF']?>?action=add_ach" method="POST" class="form-horizontal" enctype="multipart/form-data">
										   <div class="panel-body">                                                                        
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                          
											 
                                            
                                          <div class="form-group">
                                                <label class="col-md-2 control-label">Produit </label>
                                                <div class="col-md-8">                                                                                            
                                              
												<select class="form-control select2me" data-live-search="true" id="id_pro"  name="id_pro">
												
															<?php $SQL = $bd->requete("SELECT * FROM `produit`");
															while ($rows = $bd->fetch_array($SQL))
														{
															
														echo '<option  value = "'.$rows["id_pro"].'" >'.$rows["id_pro"].' '.$rows["des_pro"].'</option>';
														} ?>															   
														</select>   
                                                 
													
                                                </div>
												 <div class="col-md-2">   
												<a href="stock.php?action=add" class="btn blue"> + </a>
												  </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group"  >
                                                <label class="col-md-3 control-label">Quantité</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                      
                                                        <input type="number" class="form-control" name="qant_achat"/  required >
                                                        <span class="input-group-addon">
                                                        	<i class="fa    fa-pencil"></i>
                                                        </span>
                                                    </div>                                            
                                                   
                                                </div>
                                            </div>
											
                                           
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Prix Unitaire</label>
                                                <div class="col-md-9">                                            
                                                    <div class="input-group">
                                                        
                                                        <input type="text" class="form-control"name="prix_unitair" required/>
														<span class="input-group-addon">
                                                        	<i class="fa   fa-dollar"></i>
                                                        </span>
                                                    </div>                                            
                                                  
                                                </div>
                                            </div>
                                            
                                            
                                           
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-default"type = "reset">Vider les champs</button>                                    
                                    <button class="btn btn-primary pull-right" class="btn green" type = "submit" name = "ajouter">Ajouter</button>
                                </div>
												
												
											</div>
											<div class="form-actions">
												<div class="row">
													
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
 <?php }elseif ($action == 'list_reseaux') {

				$Domaines = Domaine::trouve_tous(); 
$cpt = 0; ?>
						<div class="row">
				<div class="col-md-12">
					<?php 
										if (!empty($msg_error)){
											echo error_message($msg_error); 
										}elseif(!empty($msg_positif)){ 
											echo positif_message($msg_positif);	
										}elseif(!empty($msg_system)){ 
											echo system_message($msg_system);
										} ?>
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption note">
								 Liste Réseaux 
							</div>
							<div class="actions">
								
								<a href="reseaux.php?action=add" class="btn  btn-default">
								 <i style="font-size: 15px;" class="fa fa-globe"></i> <i class="fa fa-plus"></i>  </a>
								
							</div>
						</div>
						
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="sample_4">
							<thead>
							<tr>
								<th>
									 N°
								</th>
								<th>
									Réseau
								</th>
								<th>
									Sous Réseau
								</th>
								<th>
									#
								</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach ($Domaines as $Domaine) { $cpt ++; ?>
							<tr>
								<td>
									<?php if (isset($Domaine->id)) {
									echo $cpt;
									} ?>
								</td>
								<td>
									<?php if (isset($Domaine->lib_Domaine)) {
									echo $Domaine->lib_Domaine;
									} ?>
								</td>
							
								<td>
									<?php if (isset($Domaine->id)) {
									$Detaildomaines = Detaildomaine::trouve_par_domaine($Domaine->id);
									foreach ($Detaildomaines as $Detaildomaine) {
										if (isset($Detaildomaine->id)) {
										echo 	$Detaildomaine->lib_DetailDomaine.'<br>';								}
									}
									
									} ?>
								</td>
								<td>
									
									<a href="reseaux.php?action=edit&id=<?php echo $Domaine->id; ?>" class="btn btn-default btn-sm">
                                                    <i class="fa fa-pencil"></i> </a>
									
								</td>
							</tr>

							
						<?php } }  ?>
							</tbody>
							</table>
						</div>
					</div>
                                        
					
					
				</div>
			</div>
					
				</div>
			</div>
			<?php } ?>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 <a href="# " target="_blank" style="color: #9b9999;" > 2020 &copy; irig.io </a> &reg;   All rights reserved
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
	<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>


<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   TableAdvanced.init();
});
</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>