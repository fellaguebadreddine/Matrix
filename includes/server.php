<?php

require_once('bd.php');
require_once('fonctions.php');

class Server{

	protected static $nom_table="servers"; 
	protected static $champs = array('id', 'id_DetailDomaine','nom','acronyme', 'logo', 'editeur','image','url_server','url_editeur','longitude','latitude','pays','region','is_Djiant','adr_line_1','adr_line_2','adr_line_3','ville','code_postal','about','phone','zoom','indicatif','authorized','created_at','updated_at','created_by','updated_by');
	public $id;
	public $id_DetailDomaine;
	public $nom;
	public $acronyme;
	public $adr_line_1;
	public $adr_line_2;
	public $adr_line_3;
	public $ville;
	public $code_postal;
	public $logo;
	public $editeur;
	public $image;
	public $url_server;
	public $url_editeur;
	public $longitude;	
	public $latitude;
	public $about;
	public $pays;
	public $region;
	public $phone;
	public $zoom;
    public $indicatif;
    public $is_Djiant;
    public $authorized;
    public $created_at;
    public $created_by;
    public $updated_at;
    public $updated_by;
	

	public static function trouve_markers_par_pays_network($id,$network){
	$q =  "SELECT *  FROM ".self::$nom_table;
	$q .= " WHERE pays =$id";
	$q .= " and id_DetailDomaine =$network";
	$q .= " ORDER BY `nom` ASC";
	$q .= ", `authorized` DESC";
	$q .= ", `is_Djiant` DESC ";
    return  self::trouve_par_sql($q);
	}
	public static function trouve_authorized_markers_par_pays_network($id,$network){
	$q =  "SELECT *  FROM ".self::$nom_table;
	$q .= " WHERE pays =$id";
	$q .= " and id_DetailDomaine =$network";
	$q .= " and authorized =1 ";
	$q .= " ORDER BY `nom` ASC";
	$q .= ", `authorized` DESC";
	$q .= ", `is_Djiant` DESC ";
    return  self::trouve_par_sql($q);
	}	
  public static function trouve_par_pays_network($id=0,$network=0) {
    $result_array = self::trouve_par_sql("SELECT  count(id) as nbr  FROM ".self::$nom_table." WHERE pays =$id  and id_DetailDomaine = $network ");
		return !empty($result_array) ? array_shift($result_array) : false;
  }

  public function nom_compler() {
    if(isset($this->nom_clie) && isset($this->prenom_clie)) {
      return $this->nom_clie . " " . $this->prenom_clie;
    } else {
      return "";
    }
  }
	public static function count_serv($id=0){
	$q =  "SELECT id FROM ".self::$nom_table;
	$q .= " WHERE id_DetailDomaine = $id "; 
    return  self::trouve_par_sql($q); 
	}
		public static function count_not_active(){
		global $bd;
		$q =  "SELECT * FROM ".self::$nom_table;
		$q .= " WHERE is_active ='0' "; 
		
		$result_array = $bd->requete($q);
		return !empty($result_array) ? $bd->num_rows($result_array): false;
	}
	
	public static function valider($login="", $mot_passe="") {
    global $bd;

    $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE password = '".SHA1($mot_passe)."' ";
    $sql .= "AND ( mail_clie= '{$login}' ";
    $sql .= "OR tel_clie = '".$login."') ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public function date_der(){
	global $bd;
     $sql  = "UPDATE ".self::$nom_table." SET ";
     $sql .= "date_der  = '".mysql_datetime()."' ";
	 $sql .= " WHERE id =".$this->id." ";
	 $sql .= "LIMIT 1 ";
	
	 $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public  function  existe(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE nom = '".$this->nom."' ";
	//$sql .= "OR tel_clie = '".$this->tel_clie."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
		public  function  existe2(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE tel_clie = '".$this->tel_clie."' ";
	//$sql .= "OR tel_clie = '".$this->tel_clie."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public  function  login_email_existe(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE login = '".$this->login."' ";
	$sql .= "AND email = '".$this->email."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public  function  login_existe(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE login = '".$this->login."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	public static function recherche($nom,$email,$tel){
	global $bd ;
	
	$q =  "SELECT * FROM ".self::$nom_table."   WHERE nom_clie like '%{$nom}%' and mail_clie like '{$email}%' and tel_clie like '{$tel}%' ;" ;
	return  self::trouve_par_sql($q);
		
	}
   
	
	public  function  mot_passe_existe(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE mot_passe = '".$this->mot_passe."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public  function  email_existe(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE email = '".$this->email."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	

	public static function count(){
	
	$users = self::not_admin();
	return count($users);
	}
	
	public static function not_sup_admin(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type !='super_administrateur'";
    return  self::trouve_par_sql($q);
	}
	public static function ens(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='Enseignant'";
    return  self::trouve_par_sql($q);
	}
	public static function eleve(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='eleve'";
    return  self::trouve_par_sql($q);
	}
	
	
	public static function select_par_ordre1($order,$crois,$start,$display){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type !='administrateur'";
	$q .= " ORDER BY {$order} {$crois} ";
	$q .= " LIMIT {$start}, {$display} "; 
	return  self::trouve_par_sql($q);
	}
	
	public static function not_admin(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type !='administrateur'";
    return  self::trouve_par_sql($q);
	}
	

	
	public static function select_par_ordre($order,$crois,$start,$display){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type !='administrateur'";
	$q .= " AND type !='super_administrateur'";
	$q .= " ORDER BY {$order} {$crois} ";
	$q .= " LIMIT {$start}, {$display} "; 
	return  self::trouve_par_sql($q);
	}
	
	public static function select_par_ordre_type($order,$crois,$start,$display,$type){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='{$type}'";
	$q .= " ORDER BY {$order} {$crois} ";
	$q .= " LIMIT {$start}, {$display} "; 
	return  self::trouve_par_sql($q);
	}
	
	public static function select_par_ordre_ens($order,$crois,$start,$display){
	$q =  "SELECT personne.* FROM personne,enseignant";
	$q .= " WHERE personne.id =enseignant.id_personne";
	$q .= " ORDER BY {$order} {$crois} ";
	$q .= " LIMIT {$start}, {$display} "; 
	return  self::trouve_par_sql($q);
	}
	
	
	// les fonction commun entre les classe
	public static function trouve_tous(){
	$q =  "SELECT * FROM ".self::$nom_table;
    return  self::trouve_par_sql($q); 
	}	

  
  public static function trouve_par_id($id=0) {
    $result_array = self::trouve_par_sql("SELECT * FROM ".self::$nom_table." WHERE id ={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  public static function trouve_not_active(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE etat ='No'";
    return  self::trouve_par_sql($q);
	}
  public static function is_active($login){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE is_active ='1'";
    $q .= "AND ( mail_clie= '{$login}' ";
    $q.= "OR tel_clie = '".$login."') ";
    return  self::trouve_par_sql($q);
	}
	  public static function is_block($login){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE is_block ='1'";
	$q .= "AND ( mail_clie= '{$login}' ";
    $q.= "OR tel_clie = '".$login."') ";
    return  self::trouve_par_sql($q);
	}
  
  // pour que ne tompa dans des erreurs foux qu'on selection tous "SELECT * FROM" 
  public static function trouve_par_sql($sql="") {
    global $bd;
    $result_set = $bd->requete($sql);
    $object_array = array();
    while ($row = $bd->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
	/* // on peu utiliser la fonction predefinit mysqli_fetch_object
	   // mais dans le cas où il y a de jointure dans la requete.... 
	while ($object = $bd->fetch_object($result_set)){
	  $object_array[] = $object;
	}
	*/
    return $object_array;
  }

	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->login 	= $record['login'];
		// $object->mot_passe 	= $record['mot_passe'];
		// $object->nom = $record['nom'];
		// $object->prenom 	= $record['prenom'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // get_object_vars returns an associative array with all attributes 
	  // (incl. private ones!) as the keys and their current values as the value
	  $object_vars = $this ->attributes();
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $object_vars);
	}

	public function save(){
	 // A new record won't have an id yet.
	 return isset($this->id)? $this->modifier() : $this->ajouter();
	}
	
	protected function attributes(){
	// return an array of attribute keys and their values
	 $attributes = array();
	 foreach(self::$champs as $field){
	     if(property_exists($this, $field)){
		     $attributes[$field] = $this->$field; 
		 }
	 }
	 return $attributes;
	}
	
	protected function sanitized_attributes(){
	 global $bd;
	 $clean_attributes = array();
	 // sanitize the values before submitting
	 // note : does not alter the actual value of each attribute
	 foreach($this->attributes() as $key => $value){
	   $clean_attributes[$key] = $bd->escape_value($value);
	 }
	  return $clean_attributes;
	}
	
	public function ajouter(){
	 global $bd;
	 $attributes = $this->sanitized_attributes();
	 $sql = "INSERT INTO ".self::$nom_table."(";
	 $sql .= join(", ", array_keys($attributes));
	 $sql .= ") VALUES (' ";
	 $sql .= join("', '", array_values($attributes));
	 $sql .= "')";
	 if($bd->requete($sql)){
	     $this->id = $bd->insert_id();
		 return true;
	 }else{
	     return false;
	 }
	}
	
    public function modifier(){
global $bd;
$attributes = $this->sanitized_attributes();
$attribute_pairs = array();
foreach($attributes as $key => $value){
 $attribute_pairs[] = "{$key}='{$value}'";
}
$sql = "update ".self::$nom_table." SET ";
$sql .= join(", ", $attribute_pairs);
$sql .= " WHERE id =". $bd->escape_value($this->id) ;
$bd->requete($sql);
return($bd->affected_rows() == 1) ? true : false ;
}
	    public function modifier_num(){
global $bd;
$attributes = $this->sanitized_attributes();
$attribute_pairs = array();
foreach($attributes as $key => $value){
 $attribute_pairs[] = "{$key}='{$value}'";
}
$sql = "update ".self::$nom_table." SET ";
$sql .= "n_immatriculation = '".$this->n_immatriculation."' ";
$sql .= " WHERE id =". $bd->escape_value($this->id) ;
$bd->requete($sql);
return($bd->affected_rows() == 1) ? true : false ;
}
	
public function supprime(){
global $bd;
$sql = "DELETE FROM ".self::$nom_table;
$sql .= " WHERE id =". $bd->escape_value($this->id) ;
$sql .=" LIMIT 1";
$bd->requete($sql);
return($bd->affected_rows() == 1) ? true : false ;
	}

	}


?>