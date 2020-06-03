<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

class Session_util {
	private $session_id;
	private $logged_in=false;
	public $site;
	public $id_utilisateur;
	public $message;
	
	
	function __construct() {
		if(!isset($_SESSION))
       {
        session_start();
		$this->session_id = session_id();
       }  

				$this->verifier_message();
		$this->verifier_login();
    
	}
	
  public function is_logged_in() {
    return $this->logged_in;
  }
  
  public function getsession_id() {
    return $this->session_id;
  }

	public function login($user) {
    // database should find user based on username/password
    if($user){
      $this->id_utilisateur = $_SESSION['id_utilisateur'] = $user->id;
	  $this->site = $_SESSION['site'] = dirname($_SERVER['PHP_SELF']); 
      $this->logged_in = true;
    }
  }
  
  public function logout() {
    unset($_SESSION['id_utilisateur']);
    unset($this->id_utilisateur);
	unset($_SESSION['site']);
	unset($this->site);
    $this->logged_in = false;
	session_destroy();
  }

  public function message($msg=""){
    if(!empty($msg)){
	 // then this is"set message"
	 // make sure you understand why $this->message=$msg wouldn't work
	 $_SESSION['message'] = $msg ;
	}else {
	  // then this is "get message"
	  return $this->message;
	}
  }
  
  
	private function verifier_login() {
    if((isset($_SESSION['id_utilisateur'])) && (isset($_SESSION['site']) )) {
      $this->id_utilisateur = $_SESSION['id_utilisateur'];
	  if($_SESSION['site'] == SITE_PATH ){
		$this->site = $_SESSION['site'] ;
        $this->logged_in = true;
	  }
	  
    } else {
      unset($this->id_utilisateur);
      $this->logged_in = false;
    }
  }
  
  private function verifier_message(){
    // Is there a message stored in the session?
	if(isset($_SESSION['message'])) {
	 // add it as an attribute and earse the stored version
	 $this->message = $_SESSION['message'];
	 unset($_SESSION['message']);
	}else{
	  $this->message = "";
	}
  }
  
  
}

$session = new Session_util();
$message= $session->message();
?>