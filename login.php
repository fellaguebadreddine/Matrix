<?php
require_once("includes/initialiser.php");
if($session->is_logged_in()) {
$user = Accounts::trouve_par_id($session->id_utilisateur);
readresser_a("index.php");
 }
  
// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['b_login'])) { // Form has been submitted.
 $login = $bd->escape_value($_POST['username']);
 $passe =$bd->escape_value($_POST['password']);
  // Check database to see if login/passe exist.
	$utilisateur_trouver = Accounts::trouve_par_login_admin($login);
if ($utilisateur_trouver and  password_verify($passe, $utilisateur_trouver->mot_passe)) {

					$session->login($utilisateur_trouver);
					//$utilisateur_trouver->date_der();
					readresser_a("index.php");		
				} else {
					
					$msg_error = "Utilisateur ou mot de passe est incorrect !";
					$session->message( $msg_error);
				
				}

} else { // Form has not been submitted.
  $login = "";
  $passe = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title> Djiant index Explorer | Login </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link href="assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="icon" type="image/png" href="assets/image/logo-white-red.png" />

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->

<div class="logo" style="padding-top: 100px;">
	<a href="index.html">
	<img src="assets/image/Djiant-logo.png" alt="" width="200">
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form action="login.php" class="login-form" method="post">
		<h3 class="form-title"> Se connecter à votre compte</h3>

			<?php 
			if (!empty($msg_error)){
				echo error_message($msg_error); 
			}elseif(!empty($msg_positif)){ 
				echo positif_message($msg_positif);	
			}elseif(!empty($msg_system)){ 
				echo system_message($msg_system);
			} ?>
			
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Utilisateur</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text"  placeholder="Utilisateur" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Mot de passe</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password"  placeholder="Mot de passe" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			</label>
			
			<button type="submit" class="btn  pull-right btn-block "  style="background-color: black;color: #ffffff;border-radius: 4px !important; " name="b_login"  id = "b_login">
			Connexion 
			</button>
		</div>
		<div>
		</div>
				

		<div class="forget-password">
                    
                </div>
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<!-- END FORGOT PASSWORD FORM -->

</div>

<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	  <a href="http://www.djiant.com/" target="_blank" style="color: #9b9999;" > djiant.com  </a> &reg;  All rights reserved
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script type="text/javascript">
	

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>