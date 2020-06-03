<?php 
require_once("../includes/initialiser.php");
	$request_method = $_SERVER["REQUEST_METHOD"];
$http_origin = $_SERVER['HTTP_ORIGIN'];

if ( $http_origin == "https://djiant.com")
{  
    header("Access-Control-Allow-Origin: $http_origin");
}
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');	

	function getDomaines()
	{
		$domaines = Domaine::trouve_tous();
		foreach ($domaines as $domaine) {
			$Domaine[] =  array( "id"=>$domaine->id,
							      "nom"=>$domaine->lib_Domaine,
							      "img_path"=>"http://index.djiant.com/assets/image/".$domaine->img
							    );
		}

		if ($domaines) {
			$response = array(
   					"domaines" =>$Domaine
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


	function getDomaine($id)
	{	$domaine = Domaine::trouve_par_id($id);
		$reseaux = Detaildomaine::trouve_par_domaine($id);
		foreach ($reseaux as $reseau) {
			$Reseau[] =  array( "id"=>$reseau->id,
							      "nom"=>$reseau->lib_DetailDomaine,
							      "description"=>$reseau->description,
							      "img_path"=>"http://index.djiant.com/assets/image/reseau/".$reseau->img,
							      "url"=>$reseau->url
							    );
		}
		if ($reseaux) {
		$response = array(
   					"reseaux" =>$Reseau
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
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				getDomaine($id);
			}
			else
			{
				getDomaines();
			}
			break;

	}
 ?>