<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $id = intval($_GET['id']);
}
if (isset($_GET['user_id'])) {
 $user_id = intval($_GET['user_id']);
}
if (isset($id)) {
   $Server = Server::trouve_par_id($id);

 
}

$findme   = 'https://';
$pos = strpos($Server->url_server, $findme);
?>
<ul class="nav nav-tabs ">
                                    <li class="active ">
                                        <a href="#tab_1" data-toggle="tab">
                                        Site web </a>
                                    </li>
                                    <li>
                                        <a href="#tab_2" data-toggle="tab">
                                        Map </a>
                                    </li>
                                    <li class="disabled">
                                        <a href="#tab_3"  >
                                        CRM </a>
                                    </li>
                                    <li class="disabled">
                                        <a href="#tab_4"  >
                                        Serveur </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <iframe width="100%" height="800" src="<?php echo $Server->url_server ?>" style="border:1px solid #eee;" ></iframe>
                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <iframe width="100%" height="800" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=<?php echo $Server->latitude.','.$Server->longitude  ?>&ie=UTF8&t=&z=12&iwloc=B&output=embed" style="border:1px solid #eee;"></iframe>
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        
                                    </div>
                                    <div class="tab-pane" id="tab_4">
                                        
                                    </div>
                                </div>

											 