<?php

require_once('bd.php');
require_once('fonctions.php');

class Accounts{

	protected static $nom_table="accounts"; 
	protected static $champs = array('id', 'username','mot_passe', 'phash', 'nom','type','idoperateur','affected_gs_dev','compte_is_admin','compte_verifier','date_creation','date_modif','date_der','tele','email','photo','facebook','twitter','active','date_active','active_by','date_block','block_by','FirstTime');
	public $id;
	public $username;
	public $mot_passe;
	public $phash;
	public $nom;
	public $type;
	public $idoperateur;
	public $FirstTime;
	public $affected_gs_dev;
	public $compte_is_admin;
	public $compte_verifier;
	public $date_creation;
	public $date_modif;
	public $date_der;
	public $tele;
	public $email;
	public $photo;
	public $facebook;
	public $twitter;
	public $active;
	public $date_active;
	public $active_by;
	public $date_block;
	public $block_by;
	

  public function nom_compler() {
    if(isset($this->nom) && isset($this->prenom)) {
      return $this->nom . " " . $this->prenom;
    } else {
      return "";
    }
  }
  public static function trouve_developpeur_ooredoo(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='3'";
	$q .= " and active ='1'";
	$q .= " and idoperateur ='3'";
	//$q .= " and affected_gs_dev ='0'";
    return  self::trouve_par_sql($q);
	}
  public static function trouve_developpeur_not_affe(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='3'";
	$q .= " and active ='1'";
	//$q .= " and affected_gs_dev ='0'";
    return  self::trouve_par_sql($q);
	}
  public static function trouve_developpeur_aff_not_affe(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='3'";
	$q .= " and active ='1'";
	$q .= " and affected_gs_dev ='0'";
    return  self::trouve_par_sql($q);
	}
	public static function count_util(){
		global $bd;
		$q =  "SELECT count(*) FROM ".self::$nom_table;
		$q .= " WHERE type !='administrateur' "; 
		
		$result_array = $bd->requete($q);
		return !empty($result_array) ? $bd->num_rows($result_array): false;
	}
		public static function count_not_active(){
		global $bd;
		$q =  "SELECT * FROM ".self::$nom_table;
		$q .= " WHERE active ='0' "; 
		
		$result_array = $bd->requete($q);
		return !empty($result_array) ? $bd->num_rows($result_array): false;
	}
	
	public static function  trouve_par_login($login){
		global $bd;
		$sql  = "SELECT * FROM ".self::$nom_table." ";
	    $sql .= "WHERE username = '".$login."' ";
	    $sql .= "and  active = 1 ";
	    $sql .= "LIMIT 1";
	    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	public static function  trouve_par_login_admin($login){
		global $bd;
		$sql  = "SELECT * FROM ".self::$nom_table." ";
	    $sql .= "WHERE type  = 'administrateur' ";
	    $sql .= "and  username = '".$login."' ";
	    $sql .= "LIMIT 1";
	    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}


	public static function valider($login="", $mot_passe="") {
    global $bd;

    $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE password = '".SHA1($mot_passe)."' ";
    $sql .= "AND ( mail= '{$login}' ";
    $sql .= "OR mobile = '".$login."') ";
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
    $sql .= "WHERE username = '".$this->username."' ";
	$sql .= "OR tele = '".$this->tele."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public  function  login_email_existe(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE username = '".$this->username."' ";
	$sql .= "AND tele = '".$this->tele."' ";
    $sql .= "LIMIT 1";
    $result_array = self::trouve_par_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public  function  login_existe(){
	 global $bd;
	 $sql  = "SELECT * FROM ".self::$nom_table." ";
    $sql .= "WHERE mail = '".$this->mail."' ";
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
    $sql .= "WHERE mail = '".$this->mail."' ";
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
	
	public static function admin(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='administrateur'";
    return  self::trouve_par_sql($q);
	}
	public static function Agence(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='Agence'";
    return  self::trouve_par_sql($q);
	}
	public static function trouve_par_type($type){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE type ='{$type}'";
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
	
	public static function trouve_par_agence($id=0){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE id_agence ={$id}";
    return  self::trouve_par_sql($q);
	}
	
	// les fonction commun entre les classe
	public static function trouve_tous() {
		return self::trouve_par_sql("SELECT * FROM ".self::$nom_table);
  }
 

  public static function trouve_par_id($id=0) {
    $result_array = self::trouve_par_sql("SELECT * FROM ".self::$nom_table." WHERE id ={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  public static function trouve_par_token($token=0) {
    $result_array = self::trouve_par_sql("SELECT * FROM ".self::$nom_table." WHERE phash ='$token' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
 public static function trouve_par_last($id=0) {
    $result_array = self::trouve_par_sql("SELECT * FROM ".self::$nom_table." WHERE id ={$id} ORDER BY `id` DESC LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  } 
 
  public static function trouve_not_active(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE active ='0'";
    return  self::trouve_par_sql($q);
	}
  public static function trouve_active(){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE active ='1'";
    return  self::trouve_par_sql($q);
	}
  public static function is_active($login){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE active ='1'";
    $q .= "AND ( mobile= '{$login}' ";
    $q.= "OR mail = '".$login."') ";
    return  self::trouve_par_sql($q);
	}
	  public static function is_block($login){
	$q =  "SELECT * FROM ".self::$nom_table;
	$q .= " WHERE active ='0'";
	$q .= "AND ( mobile= '{$login}' ";
    $q.= "OR mail = '".$login."') ";
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