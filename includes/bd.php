<?php
require_once('config.php');

class MySQLDatabase {
	
	private $connection;
	public $der_req;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	
  function __construct() {
    $this->ouvre_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mysqli_real_escape_string" );
  }

	public function ouvre_connection() {
		$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
		if (!$this->connection) {
			die("la connexion à la Base de données a échoué " . mysqli_error());
		} else {
			$db_select = mysqli_select_db($this->connection, DB_SCHEMA);
			if (!$db_select) {
				die("Sélection de la base de données a échoué: " . mysqli_error());
			}
		}
		mysqli_set_charset($this->connection,"utf8");
	}

	public function fermer_connection() {
		if(isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}

	public function requete($sql) {
		$this->der_req = $sql;
		
		$result = mysqli_query( $this->connection,$sql);
		$this->confirm_requete($result);
		return $result;
	}
	
	public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysqli_real_escape_string($this->connection, $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
	private function confirm_requete($result) {
		if (!$result) {
	    $output = "Requête de base de données a échoué:" . mysqli_error($this->connection) . "<br /><br />";
	    $output .= "dernier requet SQL : " . $this->der_req;
	    die( $output );
		}
	}
	
// doit cahanger ces fonctions on cas de changement de SGBD	
    public function fetch_array($result_set) {
       return mysqli_fetch_array($result_set);
  
    } 
  
	public function fetch_object($result_set) {
       return mysqli_fetch_object($result_set);
  
    }
     
    public function num_rows($result_set) {
      return mysqli_num_rows($result_set);
    }
	
	public function num_fields($result_set){
	 return mysqli_num_fields($result_set);
	}
  
    public function insert_id() {
     // le dernier id a insérie 
     return mysqli_insert_id($this->connection);
    } 
  
    public function affected_rows() {
       return mysqli_affected_rows($this->connection);
    }
	
	public function connection(){
	return  $this->connection;
	}

}

$database = new MySQLDatabase();
$bd =& $database;

?>