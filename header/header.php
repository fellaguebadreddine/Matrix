<!DOCTYPE html>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $titre; ?> </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<link rel="stylesheet" type="text/css" href="assets/global/css/toastr.css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/jquery-multi-select/css/multi-select.css"/>  
<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<link href="assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>
<!-- BEGIN PAGE STYLES -->
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="icon" type="image/png" href="assets/image/logo-white-red.png" />

<style>
    .number{
        float: right;
        margin-right: 2px
    }
</style>
<style>

ul, #Pays {
  list-style-type: none;
}

#Pays {
  margin: 0;
  padding: 0;
}
.continent {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
  font-size: 14px;
}

.continent::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
  font-size: 8px;
}

.continent-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg); 

}
.pays {
  display: none;
}
.pays-list{
	font-size: 14px;
	padding: 3px 4px 1px 4px;
	cursor: pointer;
	margin-bottom: 1px;
	margin-right:  12px"
}
.pays-list:hover {
    color: #6c6a6a;
    text-decoration: none;
    background-color: #e3e3e3;
    border-radius: 4px !important;
    /* border: 1px solid #fff; */
}
ul, #domaine {
  list-style-type: none;
}

#domaine {
  margin: 0;
  padding: 0;
}
.domaine {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
  font-size: 14px;
}

.domaine::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
  font-size: 8px;
}

.domaine-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg); 

}

.network {
  display: none;
}

.active {
  display: block;

}
.network-list{
	font-size: 14px;
	padding: 3px 4px 1px 4px;
	cursor: pointer;
	margin-bottom: 1px;
}
.network-list:hover {
    color: #6c6a6a;
    text-decoration: none;
    background-color: #e3e3e3;
    border-radius: 4px !important;
    /* border: 1px solid #fff; */
}

li.selected {
    color: #FFF;
    text-decoration: none;
    background-color: #008DD2;
    border-radius: 4px !important;
    /* border: 1px solid #fff; */
}
a.selected {
    color: #FFF;
    text-decoration: none;
    background-color: #008DD2;
    border-radius: 4px !important;
    /* border: 1px solid #fff; */
}
.check-circle:focus{
color: #FFF !important;

}
.scrollable-menu {
    height: auto;
    max-height: 620px;
    overflow-x: hidden;
}
.scrollable {
    height: auto;
    max-height: 800px;
    overflow-x: hidden;
}
</style>
<style>
/* width */
::-webkit-scrollbar {
  width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f2f2f2; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #e3e3e3;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #e3e3e3; 
}
</style>


</head>