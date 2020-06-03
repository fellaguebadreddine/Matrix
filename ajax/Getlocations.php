<?php
require_once("../includes/initialiser.php");
if (isset($_GET['id'])) {
 $address =  htmlspecialchars(trim($_GET['id'])) ;
}else{
        echo 'Content not found....';
}
    $latitude =0;
    $longitude =0;

$latLong = getLatLong($address);
$latitude = $latLong['latitude']?$latLong['latitude']:'0';
$longitude = $latLong['longitude']?$latLong['longitude']:'0';

?>
                        
                        
                                    
                                        
                                         <label class="col-md-3 control-label text-left">Lat</label>
                                            <div class="col-md-4">
                                                <input name="lat" type="text" class="form-control input-sm" value ="<?php if (isset($latitude)){ echo $latitude; } ?>" required>
                                            </div>
                                            <label class="col-md-2 control-label text-left" style="width: 11%;">Long</label>
                                            <div class="col-md-3" style="width: 30%;">
                                                <input name="long" type="text"    class="form-control input-sm" value ="<?php if (isset($longitude)){ echo $longitude ; } ?>" required="">
                                            </div>
                                
                                


