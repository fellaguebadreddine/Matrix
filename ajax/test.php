<?php
require_once("../includes/initialiser.php");

$cpt =0;

$SQL1 = $bd->requete("SELECT DISTINCT pays FROM `servers` WHERE `pays` LIKE '%United States%'");
while ($rows = $bd->fetch_array($SQL1)){ $cpt ++;
    $ppp = $rows['pays'];
   $pays =  str_replace('United States-', '', $rows['pays']);
   $pays =  str_replace('-', ' ', $pays);
 echo $pays.'  '.$cpt.''.$rows['pays'].'<br>';
 $SQL = $bd->requete("UPDATE servers set pays = '$pays' WHERE  pays like '$ppp'  ");
}
?>
                                        