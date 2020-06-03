<?php 
require_once("../includes/initialiser.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
	$headers = apache_request_headers();
header('Access-Control-Allow-Origin: https://reseau-regional.herokuapp.com');
header('Access-Control-Allow-Origin: https://reseau-technopark.herokuapp.com');
$http_origin = $_SERVER['HTTP_ORIGIN'];

if ($http_origin == "https://reseau-regional.herokuapp.com" || $http_origin == "https://reseau-technopark.herokuapp.com"  || $http_origin == "https://technoparks.djiant.com" ||  $http_origin == "https://regional.djiant.com"||  $http_origin == "https://djiant.com"||   $http_origin == "http://localhost:4200")
{  
    header("Access-Control-Allow-Origin: $http_origin");
}
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
	
	function getMarkers($id)
	{

		if ($id==1) {
			$Continents = Continent::trouve_id_and_name_CCI(); 
		}else{
			$Continents = Continent::trouve_id_and_name();
		}
		
		foreach ($Continents as $Continent) { 
			$Pays = Pays::trouve_par_continent_id_display($Continent->id);
			foreach ($Pays as $Pays){
			$Server = Server::trouve_authorized_markers_par_pays_network($Pays->id,$id);
			$pays[]= array(  	  "id"=>$Pays->id,
							      "nom"=>$Pays->name,
							      "markers" => $Server
							    );
		}
			
			$Contin[] =  array(   "id"=>$Continent->id,
							      "nom"=>$Continent->name,
							      "pays" => $pays
							    );
			unset($pays);
		}

		if ($Continents) {
			$response = array(
   					"Continents" =>$Contin
			     );
	      			http_response_code(200);
 					header('Content-Type: application/json');
			    // tell the user no categories found
			   echo json_encode($response, JSON_PRETTY_PRINT);
			
		}else{
			http_response_code(400);
   				$response = array(
   					"code" => " 400 ",
			     	"message" => " not found");
 
			    // tell the user no categories found
			   echo json_encode($response, JSON_PRETTY_PRINT);
			   exit;

		}
	}




switch($request_method)
	{
		
		case 'GET':
			// Get Domaines
			if(!empty($_GET["marker"]))
			{
				$id=intval($_GET["marker"]);
				getMarkers($id);
			}

	}
 ?>