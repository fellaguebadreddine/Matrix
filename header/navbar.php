<body class="page-header-fixed page-quick-sidebar-over-content page-full-width">
<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">

		<!-- BEGIN HORIZANTAL MENU -->
		<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
		<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
		<div class="hor-menu hidden-sm hidden-xs">
			<ul class="nav navbar-nav">
				<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
				<li class="mega-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true"> <i class="fa fa-globe" style="font-size: 21px;     vertical-align: sub"></i>
					Djiant Matrix <i class="fa fa-angle-down"></i>
					</a>
					<?php 
						$cpt = 0;
						$cpt1 = 0;
						$domaines = Domaine::trouve_tous();
						$Continents = Continent::trouve_tous();
					 ?>
					<ul class="dropdown-menu" style="min-width: 600px;height: 700px;">
						<li>
							<!-- Content container to add padding -->
							<div class="mega-menu-content">
								<div class="row">
									<div class="col-md-6">
										<div class="note" style="font-weight: 600">
													<span>Réseaux</span>
												</div>
												<br>
										<ul id="domaine" class="mega-menu-submenu">
											
											<?php foreach ($domaines as $domaine) { $cpt++; ?>			
  			  <li  style="padding: 0px 0px;" ><span class="domaine <?php if ($cpt == 1) { echo'domaine-down'; }?> "> <img style="margin-right: 10px;" src="assets/image/<?php echo $domaine->img; ?>" width="22px"><?php echo $domaine->lib_Domaine; ?></span>
    			<ul class="network   <?php if ($cpt == 1) { echo'active'; }?>">
    	<?php $detaildomaines = Detaildomaine::trouve_par_domaine($domaine->id); foreach ($detaildomaines as $detaildomaine){ $count_srv = Server::count_serv($detaildomaine->id); ?>
      				<li  id="<?php echo $detaildomaine->lib_DetailDomaine; ?>" class="network-list" value="<?php echo $detaildomaine->id; ?>" >  <i class="fa fa-server" style="font-size: 15px;margin-right: 3px;"></i> <?php echo $detaildomaine->lib_DetailDomaine; ?>   <span class="number"> <?php echo count($count_srv); ?></span> </li> <?php } ?>
   			   </ul>
  			  </li><?php } ?>
										</ul>
									</div>
									<div class="col-md-6 ">
										<div class="note" style="font-weight: 600">
													<span>Pays</span>
												</div>
												<br>
										<div class="scrollable-menu  list_pays">
												

										<ul id="Pays" class="mega-menu-submenu  ">
											
											<?php foreach ($Continents as $Continent) {  ?>	
								  <li style="padding: 2px 0px;"  ><span class="continent"> <img style="margin-right: 6px;" src="assets/image/A-DjiantNetwork.svg" width="22px"> <?php echo $Continent->name; ?></span>
								  </li>
								<?php } ?>
										</ul>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li>
								
			</ul>
		</div>
		<div class="page-logo">
		<div class="note" style="display: none" id="domaine_name" >
			
		</div>	
			
		
		</div>
		<div class="page-logo">
		<div class="note" style="display: none"  id="pays_name" >
			
		</div>	
			
		
		</div>
		<!-- END HORIZANTAL MENU -->

		<!-- BEGIN HEADER SEARCH BOX -->
		<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
		<form class="search-form open"  method="GET">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search..." name="query">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="fa fa-search"></i></a>
				</span>
			</div>
		</form>
		<!-- END HEADER SEARCH BOX -->

		<!-- BEGIN TOP NAVIGATION MENU -->

		<div class="top-menu">
			
			<ul class="nav navbar-nav pull-right ">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="assets/admin/layout/img/avatar3_small.png">
					<span class="username username-hide-on-mobile">
					<?php if (!empty($user->nom_compler())) {
						echo  $user->nom_compler() ;
					} else{echo  $user->nom; } ?></span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="#">
							<i class="icon-user"></i> Mon profil </a>
						</li>
						<li>
							<a href="#">
							<i class="icon-lock"></i> Fermer la session </a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="logout.php">
							<i class="icon-key"></i> Déconnexion </a>
						</li>
					</ul>
				</li>
				
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>

		</div>
		
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse"> 
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<!-- END SIDEBAR MENU -->
			<ul class="page-sidebar-menu page-sidebar-menu-closed"  data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search " action="recherche.php" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							
							
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<?php if ($user->type == 'administrateur') {    ?>
								<li <?php if ($active_menu == 'index')  { echo 'class="start active open"'; }  ?> >
					<a href="index.php">
					<i class="fa fa-dashboard"></i>
					<span class="title">TABLEAU DE BORD</span>
					<span class="selected"></span>
					</a>
				</li>
				<li <?php if ($active_menu == 'reseaux')  { echo 'class="start active open"'; }  ?> >
					<a href="javascript:;">
					<i class="fa fa-globe"></i>
					<span class="title">RÉSEAUX</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li  <?php if ($active_submenu == 'list_reseaux')  { echo 'class="active"'; }  ?>  >
							<a href="reseaux.php?action=list_reseaux">
							
							LISTE RÉSEAUX
							</a>
						</li>
						<li  <?php if ($active_submenu == 'add_ach')  { echo 'class="active"'; }  ?>  >
							<a href="stock.php?action=add_ach">
							
							SOUS RÉSEAUX
							</a>
						</li>
						
						
					</ul>
				</li>


				<?php } ?>
			</ul>
		</div>
	</div>
	<!-- END SIDEBAR -->
